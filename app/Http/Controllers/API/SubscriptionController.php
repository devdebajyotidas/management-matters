<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Learner;
use App\Models\Subscription;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

require base_path('vendor/autoload.php');
use DateTime;

use App\Models\Organization ;
use App\Models\User;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller AS AnetController;
use League\Flysystem\Config;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        $invoiceno=config('constants.INVOICE_NO')+1;

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


        $amount=$license*config('constants.BASE_PRICE');

        if($license > config('constants.DISCOUNT_ABOVE')){
            $amount=$amount-(($amount*config('constants.DISCOUNT'))/100);
        }

        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('constants.AUTHORIZE_ID'));
        $merchantAuthentication->setTransactionKey(config('constants.AUTHORIZE_KEY'));

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
        $billTo->setFirstName(isset((explode(' ',$name))[0]) ? (explode(' ',$name))[0] : 'First');
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
    public function update(Request $req,$subscriptionId){

        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('constants.AUTHORIZE_ID'));
        $merchantAuthentication->setTransactionKey(config('constants.AUTHORIZE_KEY'));

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
        $merchantAuthentication->setName(config('constants.AUTHORIZE_ID'));
        $merchantAuthentication->setTransactionKey(config('constants.AUTHORIZE_KEY'));

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
        $merchantAuthentication->setName(config('constants.AUTHORIZE_ID'));
        $merchantAuthentication->setTransactionKey(config('constants.AUTHORIZE_KEY'));

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
