<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Learner;
use App\Models\Subscription;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

require base_path('vendor/autoload.php');
use DateTime;

use App\Models\Organization ;
use App\Models\User;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller AS AnetController;
use League\Flysystem\Config;

class SubscriptionController extends Controller
{

    public function purchase($id){
        $organization = Organization::with(['subscription'])->find($id);
        $data['page'] = 'subscription';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/' .Auth::user()->account_id;
        $data['organization'] = $organization;

        return view('subscription.purchase',$data);

    }

    public function subscribe(Request $req,$id){

        DB::beginTransaction();

        $cardnum=NULL;
        $name=NULL;
        $cvv=NULL;
        $expdate=NULL;
        $license=NULL;
        $binterval=NULL;
        if(isset($req->withtrial)){
            $start=date('Y-m-d', strtotime('+'.config('constants.TOTAL_OCCURENCE',strtotime(date('Y-m-d')))));
        }
        else{
            $start=date('Y-m-d', strtotime('+1 day',strtotime(date('Y-m-d'))));
        }
        $invoiceno=config('constants.invoice')+1;

        if(isset($req->card_number)){
            $cardnum=$req->card_number;
            $name=!empty($req->name_on_card) ? $req->name_on_card : 'No Name';
            $expdate=$req->expiry_date;
            $binterval=isset($req->billing_interval) ? $req->billing_interval : config('constants.DEFAULT_INTERVAL');
            $license=isset($req->licenses) ? $req->licenses : config('constants.DEFAULT_LICENSE') ;
        }
        else{
            if(session('role')=='organization'){
                $organization=Organization::find($id);

                $cardnum=$organization->card_number;
                $name=!empty($organization->name_on_card) ? $organization->name_on_card : 'No Name';
                $expdate=$organization->expiry_date;
                $binterval=$organization->subscription->billing_interval;
                $license=$organization->subscription->licenses;
            }
            elseif(session('role')=='learner'){

                $learner=Learner::find($id);
                $cardnum= $learner->card_number;
                $name= !empty($learner->name_on_card) ? $learner->name_on_card : 'No Name';
                $expdate= $learner->expiry_date;
                $binterval=$learner->subscription->billing_interval;
                $license=1;
            }
        }


        $amount=$license*config('constants.price');

        if($license > config('constants.discountabove')){
            $amount=$amount-(($amount*config('constants.discount'))/100);
        }

        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('constants.loginid'));
        $merchantAuthentication->setTransactionKey(config('constants.transkey'));

        $refId = 'ref' . time();

        // Subscription Type Info
        $subscription = new AnetAPI\ARBSubscriptionType();
        $subscription->setName("Sample Subscription");
        $interval = new AnetAPI\PaymentScheduleType\IntervalAType();
        $interval->setLength($binterval);
        $interval->setUnit("days");
        $paymentSchedule = new AnetAPI\PaymentScheduleType();
        $paymentSchedule->setInterval($interval);
        $paymentSchedule->setStartDate(new DateTime($start));
        $paymentSchedule->setTotalOccurrences(config('constants.TOTAL_OCCURENCE'));
        $paymentSchedule->setTrialOccurrences(config('constants.TRIAL_OCCURENCE'));
        $subscription->setPaymentSchedule($paymentSchedule);

        $subscription->setAmount($amount);
        $subscription->setTrialAmount(config('constants.TRIAL_AMOUNT'));

        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardnum);
        $creditCard->setExpirationDate($expdate);
        $payment = new AnetAPI\PaymentType();
        $payment->setCreditCard($creditCard);
        $subscription->setPayment($payment);
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($invoiceno);
        $order->setDescription("Description of the subscription");
        $subscription->setOrder($order);

        $billTo = new AnetAPI\NameAndAddressType();
        $billTo->setFirstName(isset((explode(' ',$name))[0]) ? (explode(' ',$name))[1] : 'First');
        $billTo->setLastName(isset((explode(' ',$name))[1]) ? (explode(' ',$name))[1] : 'Last');
        $subscription->setBillTo($billTo);
        $request = new AnetAPI\ARBCreateSubscriptionRequest();
        $request->setmerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setSubscription($subscription);
        $controller = new AnetController\ARBCreateSubscriptionController($request);
        $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
        {

            $sub=Subscription::where('account_id',$id)->first();
            $sub->subscription_id= $response->getSubscriptionId();
            $sub->amount=$amount;
            $sub->is_subscribed=1;
            $updateresponse=$sub->update();

            if($updateresponse){

                DB::commit();
                return true;

            }
            else{

                DB::rollBack();
                return false;

            }

        }
        else
        {
            DB::rollBack();
            return false;
        }
    }

    public function process(Request $req,$id){

        DB::beginTransaction();

        $subs=Subscription::where('account_id',$id)->first();
        if(isset($req->licenses)){
            $license=$req->licenses;
            $cardnum=$req->number;
            $name=!empty($req->name) ? $req->name : 'No Name';
            $expdate=$req->expdate;
            $cvv=$req->cvv;
            $invoiceno=config('constants.invoice')+1;


            $amount=$license*config('constants.price');

            $customer=Organization::find($id);

            if($license > config('constants.discountabove')){
                $amount=$amount-(($amount*config('constants.discount'))/100);
            }

            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(config('constants.loginid'));
            $merchantAuthentication->setTransactionKey(config('constants.transkey'));

            $refId = 'ref' . time();

            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber($cardnum);
            $creditCard->setExpirationDate($expdate);
            $creditCard->setCardCode($cvv);

            $paymentOne = new AnetAPI\PaymentType();
            $paymentOne->setCreditCard($creditCard);

            $order = new AnetAPI\OrderType();
            $order->setInvoiceNumber($invoiceno);
            $order->setDescription("Extra ".$license." licenses purchase");

            $customerAddress = new AnetAPI\CustomerAddressType();
            $customerAddress->setFirstName((explode(' ',$name))[0]);
            $customerAddress->setLastName((explode(' ',$name))[1]);

            $duplicateWindowSetting = new AnetAPI\SettingType();
            $duplicateWindowSetting->setSettingName("duplicateWindow");
            $duplicateWindowSetting->setSettingValue("60");

            $customerData = new AnetAPI\CustomerDataType();
            $customerData->setType("individual");
            $customerData->setId($customer->id);
            $customerData->setEmail($customer->email);

            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authCaptureTransaction");
            $transactionRequestType->setAmount($amount);
            $transactionRequestType->setOrder($order);
            $transactionRequestType->setPayment($paymentOne);
            $transactionRequestType->setBillTo($customerAddress);
            $transactionRequestType->setCustomer($customerData);
            $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);

            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setRefId($refId);
            $request->setTransactionRequest($transactionRequestType);

            $controller = new AnetController\CreateTransactionController($request);
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
            if ($response != null) {

                if ($response->getMessages()->getResultCode() =='Ok') {

                    $tresponse = $response->getTransactionResponse();

                    if ($tresponse != null && $tresponse->getMessages() != null) {
                        $req->amount=floatVal($subs->amount)+$amount;
                        $update=$this->update($req, $subs->subscription_id);

                        if($update){

                            $data['account_id']=$id;
                            $data['merchant_response']=$tresponse->getMessages()[0]->getDescription();
                            $data['transaction_id']=$tresponse->getTransId();
                            $data['amount']=$amount;
                            $data['status']=$tresponse->getResponseCode();
                            $trans=Transactions::create($data);
                            $subs->licenses=intval($subs->licenses)+intval($req->licenses);
                            $subs->amount=floatval($subs->amount)+$amount;
                            $subupdate=$subs->update();
                            if($trans && $subupdate){
                                DB::commit();
                                return redirect()->back()->with('success', 'Payment has been accepted');
                            }
                            else{

                                $refund=$this->refund($tresponse->getTransId(),$cardnum,$expdate,$amount);
                                DB::rollBack();

                                if($refund){
                                    return redirect()->back()->withErrors(["Unable to make the transaction, your money will be refunded shortly "]);
                                }
                                else{
                                    return redirect()->back()->withErrors(["Unable to make the transaction, please contact the admin"]);
                                }


                            }

                        }
                        else{


                            $refund=$this->refund($tresponse->getTransId(),$cardnum,$expdate,$amount);
                            DB::rollBack();
                            if($refund){
                                return redirect()->back()->withErrors(["Unable to make the transaction, your money will be refunded shortly "]);
                            }
                            else{
                                return redirect()->back()->withErrors(["Unable to make the transaction, please contact the admin"]);
                            }

                        }

                    } else {
                        DB::rollBack();
                        return redirect()->back()->withErrors(['Something went wrong!']);

                    }
                } else {
                    DB::rollBack();
                    return redirect()->back()->withErrors(['Something went wrong!']);

                }
            } else {
                DB::rollBack();
                return redirect()->back()->withErrors(['Something went wrong!']);
            }

        }
        else{
            DB::rollBack();
            return redirect()->back()->withErrors(['Something went wrong!']);
        }

    }

    public function update(Request $req,$subscriptionId){

        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('constants.loginid'));
        $merchantAuthentication->setTransactionKey(config('constants.transkey'));

        $refId = 'ref' . time();
        $subscription = new AnetAPI\ARBSubscriptionType();
        if(!empty($req->card_number) && !empty($req->expiry_date)){
            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber($req->card_number);
            $creditCard->setExpirationDate($req->expiry_date);
            $payment = new AnetAPI\PaymentType();
            $payment->setCreditCard($creditCard);
            $subscription->setPayment($payment);
        }
        if(!empty($req->amount)){
            $subscription->setAmount($req->amount);
        }

        $request = new AnetAPI\ARBUpdateSubscriptionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setSubscriptionId($subscriptionId);
        $request->setSubscription($subscription);
        $controller = new AnetController\ARBUpdateSubscriptionController($request);
        $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
        {
            return true;

        }
        else
        {
            return false;
        }


    }

    public function cancel($subscriptionId){

        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('constants.loginid'));
        $merchantAuthentication->setTransactionKey(config('constants.transkey'));

        // Set the transaction's refId
        $refId = 'ref' . time();
        $request = new AnetAPI\ARBCancelSubscriptionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setSubscriptionId($subscriptionId);
        $controller = new AnetController\ARBCancelSubscriptionController($request);
        $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
        {
            $errorMessages = $response->getMessages()->getMessage();
            $subscription=Subscription::where('subscription_id',$subscriptionId)->first();
            $subscription->is_subscribed=0;
            $subscription->subscription_id='';
            $subscription->update();
            return true;
        }
        else
        {
            return false;

        }

    }

    public function refund($refTransId,$card,$expdate,$amount){
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('constants.loginid'));
        $merchantAuthentication->setTransactionKey(config('constants.transkey'));

        $refId = 'ref' . time();
        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($card);
        $creditCard->setExpirationDate($expdate);
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
        //create a transaction
        $transactionRequest = new AnetAPI\TransactionRequestType();
        $transactionRequest->setTransactionType( "refundTransaction");
        $transactionRequest->setAmount($amount);
        $transactionRequest->setPayment($paymentOne);
        $transactionRequest->setRefTransId($refTransId);

        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest( $transactionRequest);
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
        if ($response != null)
        {
            if($response->getMessages()->getResultCode() =='Ok')
            {
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null)
                {
                   return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}
