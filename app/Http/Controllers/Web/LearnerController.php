<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

use App\Models\Learner;
use App\Models\User;
use App\Models\Department;
use App\Models\Organization;
use App\Models\Assessment;
use App\Models\Quiz;
use App\Models\Ticket;
use App\Models\TicketAssignment;
use App\Models\Award;
use App\Models\CostOfNot;
use Illuminate\Support\Facades\Mail;

class LearnerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checksub')->only(['index','show']);
    }

    public function index()
    {
        $data['page'] = 'learners';
        $data['role'] = session('role');
        $data['departments'] = Department::all();
        $data['learners'] = Learner::withTrashed()->with(['department.organization','user'])->get();
        $data['organizations'] = Organization::all();
        $data['prefix']  = '';
        return view('learners.index', $data);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $data['learner'] = $request->get('learner');
        $data['user'] = $request->get('user');

        $data['user']['verification_token']= $vtoken=md5(microtime());
        $subscription['subscription_id']='';
        $subscription['start_date']=date('Y-m-d H:i:s');
        $subscription['status']=1;

//        if(intval($request->get('learner')['organization']))
//        {
//            $newRequest = Request::create('organizations/'. intval($request->get('learner')['organization']) . '/learners', 'POST', $request->all());
//            $response = Route::dispatch($newRequest);
//            return redirect()->intended(url('learners'));
//        }

        $learnerValidator = Validator::make($data['learner'], Learner::$rules['create']);
        $userValidator = Validator::make($data['user'], User::$rules['create']);

        if ($learnerValidator->passes() && $userValidator->passes()) {
            $user = User::make($data['user']);
            $learner = Learner::create($data['learner']);

            if($learner->user()->save($user)){
                $user->attachRole('learner');
                if(empty($learner->organization)){
                    $sub = Subscription::make($subscription);

                    $learner->subscription()->save($sub);
                    if(!empty($learner->name_on_card) && !empty($learner->card_number) && !empty($learner->expiry_date)){
                        $newreq= new \Illuminate\Http\Request();
                        $newreq->name_on_card=$learner->name_on_card;
                        $newreq->card_number=$learner->card_number;
                        $newreq->expiry_date=$learner->expiry_date;
                        $newreq->srole='App\Models\Learner';
                        app('App\Http\Controllers\Web\SubscriptionController')->subscribe($newreq,$learner->id);
                    }

                }

                $email['logo']=asset('assets/img/mm-logo.png');
                $email['name']=$learner->name;
                $email['url']=url('verification').'?token='.$vtoken;


                $config=new \stdClass();
                $config->from=config('constants.EMAIL_FROM');
                $config->cc=config('constants.EMAIL_BCC');
                $config->bcc=config('constants.EMAIL_CC');

                Mail::send('emails.confirmation', $email, function($message) use($user,$config)
                {
                    $message->from($config->from,'Management Matters');
                    $message->cc($config->cc,'Samir Maikap');
                    $message->bcc($config->bcc,'Debajyoti Das');
                    $message->to($user->email);
                    $message->subject('Email verification required');

                });

                if(!empty(session('role'))){
                    $email['password']=$data['user']['password'];
                    $email['email']=$user->email;
                    $email['url']=url('login');
                    Mail::send('emails.welcome', $email, function($message) use($user,$config)
                    {
                        $message->from($config->from,'Management Matters');
                        $message->cc($config->cc,'Samir Maikap');
                        $message->bcc($config->bcc,'Debajyoti Das');
                        $message->to($user->email);
                        $message->subject('Welcome Abord');

                    });
                }
                DB::commit();

                return redirect()->back()->with('success', 'Learner added successfully');
            }
            else{
                DB::rollBack();
                return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong']);
            }

        }
        else
        {
            DB::rollBack();
            $errors = $learnerValidator->errors()->merge($userValidator->errors());
            return redirect()->back()->withInput($request->all())->withErrors($errors);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $learner = Learner::find($id);
        $data['page'] = 'learners';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/' .Auth::user()->account_id;
        $data['learner'] = $learner;
        $data['departments']=Department::where('organization_id',Auth::user()->account_id)->get();

        return view('learners.profile',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $data['learner'] = $request->get('learner');
        $data['user'] = $request->get('user');
        $srole='App\Models\Learner';
        $sub=Subscription::where('account_id',$id)->where('account_type',$srole)->first();

        $learnerValidator = Validator::make($data['learner'], Learner::$rules['update']);
        if(trim($data['user']['password']) == '' || $data['user']['password'] == null){
            unset($data['user']['password']);
            unset($data['user']['password_confirmation']);
        }

        $userValidator = Validator::make($data['user'], User::$rules['update']);

        if ($learnerValidator->passes() && $userValidator->passes()) {

            if ($request->hasFile('learner.image')) {
                $file = $request->file('learner.image');
                $name = time().rand(100,999).".".$file->getClientOriginalExtension();
                if($file->move('uploads/',$name)){
                    $data['learner']['image'] = $name;
                }else{
                    $data['learner']['image'] = null;
                }
            }

            $learner = Learner::find($id);
            $learner->fill($data['learner']);

            $user = User::find($learner->user->id);
            $user->fill($data['user']);
            $newreq= new \Illuminate\Http\Request();
            if(isset($sub->subscription_id) && !empty($sub->subscription_id)){
                $newreq->card_number=$data['learner']['card_number'];
                $newreq->expiry_date=$data['learner']['expiry_date'];
                $newreq->srole='App\Models\Learner';
                app('App\Http\Controllers\Web\SubscriptionController')->update($newreq,$sub->subscription_id);

            }
            else{
                if(!empty($data['learner']['card_number']) && !empty($data['learner']['expiry_date'])){
                    $newreq->name_on_card=$data['learner']['name_on_card'];
                    $newreq->card_number=$data['learner']['card_number'];
                    $newreq->expiry_date=$data['learner']['expiry_date'];
                    $newreq->srole='App\Models\Learner';
                    app('App\Http\Controllers\Web\SubscriptionController')->subscribe($newreq,$id);
                }
            }

            if($learner->save() && $user->save())
            {
                DB::commit();
                return redirect()->back()->with('success', 'Learner updated successfully');
            }
            else
            {
                DB::rollBack();
                return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
            }

        }
        else
        {
            DB::rollBack();
            $errors = $learnerValidator->errors()->merge($userValidator->errors());
            return redirect()->back()->withInput($request->all())->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $srole='App\Models\Learner';
        $learner = Learner::withTrashed()->where('id', $id)->first();
        $subscription=Subscription::where('account_id',$id)->where('account_type',$srole)->first();
        if($learner->trashed())
        {
            $learner->forceDelete();
            if(isset($subscription->subscription_id) && !empty($subscription->subscription_id)){
                app('App\Http\Controllers\Web\SubscriptionController')->cancel($subscription->subscription_id);
            }
            return redirect()->back()->with(['success' => 'Learner removed successfully']);
        }
        else
        {
            $learner->delete();
            if(isset($subscription->subscription_id) && !empty($subscription->subscription_id)){
                app('App\Http\Controllers\Web\SubscriptionController')->cancel($subscription->subscription_id);
            }
            return redirect()->back()->with(['success' => 'Learner archived successfully']);
        }
    }

    public function restore(Request $request, $id)
    {
        $learner = Learner::withTrashed()->where('id', $id)->first();
        $subscription=Subscription::where('account_id',$id)->first();
        if($learner->restore())
        {
            $newreq= new \Illuminate\Http\Request();
            if(isset($subscription)){
                $newreq->name_on_card=$learner->name_on_card;
                $newreq->card_number=$learner->card_number;
                $newreq->expiry_date=$learner->expiry_date;
                $newreq->billing_interval=$subscription->billing_interval;
                $newreq->licenses=$subscription->licenses;
                $newreq->srole='App\Models\Learner';
                $response=app('App\Http\Controllers\Web\SubscriptionController')->subscribe($newreq,$learner->id);
            }

            return redirect()->back()->with(['success' => 'Learner restored successfully']);
        }
        else
        {
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }

    }

    public function remove(Request $request,$id){
        $tcount=0;
        $qcount=0;
        $amcount=0;
        $awardcount=0;

        $learner = Learner::withTrashed()->find($id);

        $srole='App\Models\Learner';
        $subscription=Subscription::where('account_id',$id)->where('acccount_type',$srole)->first();
        $user=User::where('account_id',$id)->first();
        $assessment=Assessment::where('learner_id',$id)->get();
        $award=Award::where('learner_id',$id)->get();
        $quiz=Quiz::where('learner_id',$id)->get();
        $tickets=Ticket::withTrashed()->where('learner_id',$id)->get();

        if(count($assessment) > 0){
            foreach ($assessment as $am){
                $am->forceDelete();
                $amcount++;
            }
        }
        else{
            $amcount=1;
        }

        if(count($award) > 0){
            foreach ($award as $aw){
                $aw->forceDelete();
                $awardcount++;
            }
        }
        else{
            $awardcount=1;
        }

        if(count($quiz) > 0){
            foreach ($quiz as $qz){
                $qz->forceDelete();
                $qcount++;
            }
        }
        else{
            $qcount=1;
        }

        if(count($tickets) > 0){
            foreach ($tickets as $tk){
                $assignment=TicketAssignment::where('ticket_id',$tk->id)->get();
                if(count($assignment) > 0){
                    foreach ($assignment as $as){
                        $as->forceDelete();
                    }
                    $tk->forceDelete();
                    $tcount++;
                }
                else{
                    $tk->forceDelete();
                    $tcount++;
                }

            }
        }
        else{
            $tcount=1;
        }



        if(!empty($subscription->subscription_id)){
            app('App\Http\Controllers\Web\SubscriptionController')->cancel($subscription->subscription_id);
            if($subscription->forceDelete()){
                $subdel=1;
            }
            else{
                $subdel=0;
            }
        }
        else{
            $subdel=1;
        }

        if($learner){
            $ldel=$learner->forceDelete();
        }
        else{
            $ldel=true;
        }
        if($user){
            $udel=$user->forceDelete();
        }
        else{
            $udel=true;
        }

        if($subdel > 0 && $tcount > 0 && $qcount > 0 && $awardcount > 0 && $amcount > 0 && $ldel && $udel  ){

            $email['name']=isset($learner->name) ? $learner->name : '';
            $email['logo']=asset('assets/img/mm-logo.png');

            $config=new \stdClass();
            $config->from=config('constants.EMAIL_FROM');
            $config->cc=config('constants.EMAIL_BCC');
            $config->bcc=config('constants.EMAIL_CC');

            Mail::send('emails.deactivation', $email, function($message) use($user,$config)
            {
                $message->from($config->from,'Management Matters');
                $message->cc($config->cc,'Samir Maikap');
                $message->bcc($config->bcc,'Debajyoti Das');
                $message->to($user->email);
                $message->subject('Account Removed');

            });

            DB::commit();

            return redirect()->back()->with(['success' => 'Learner removed successfully']);
        }
        else{
            DB::rollBack();
            return redirect()->back()->withErrors(['Something went wrong']);
        }
    }


    function resetassessment($id){
        DB::beginTransaction();

        $amcount=0;

        $assessment = Assessment::where('learner_id', $id)->get();
        if(count($assessment) > 0){
            foreach ($assessment as $am){
                $am->delete();
                $amcount++;
            }
        }
        else{
            $amcount=1;
        }

        if($amcount > 0){
            DB::commit();
            return redirect()->back()->with(['success' => 'Assessment has been reset']);
        }
        else{
            DB::rollBack();
            return redirect()->back()->withErrors(['Something went wrong']);
        }
    }

    function resetconmb($id){
        DB::beginTransaction();

        $amcount=0;
        $cost = CostOfNot::where('learner_id', $id)->get();
        if(count($cost) > 0){
            foreach ($cost as $am){
                $am->delete();
                $amcount++;
            }
        }
        else{
            $amcount=1;
        }

        if($amcount > 0){
            DB::commit();
            return redirect()->back()->with(['success' => 'Cost of not managing better has been reset']);
        }
        else{
            DB::rollBack();
            return redirect()->back()->withErrors(['Something went wrong']);
        }
    }

    function resetquiz($id){
        DB::beginTransaction();

        $amcount=0;
        $quiz= Quiz::where('learner_id', $id)->get();
        if(count($quiz) > 0){
            foreach ($quiz as $am){
                $am->delete();
                $amcount++;
            }
        }
        else{
            $amcount=1;
        }

        if($amcount > 0){
            DB::commit();
            return redirect()->back()->with(['success' => 'Quiz has been reset']);
        }
        else{
            DB::rollBack();
            return redirect()->back()->withErrors(['Something went wrong']);
        }
    }


    function changedepartment(Request $request,$id){
        DB::beginTransaction();

        $learner=Learner::find($id);
        $learner->department_id=$request->department;
        if($learner->update()){
            DB::commit();
            return redirect()->back()->with(['success' => 'Learner department has been changed']);
        }
        else{
            DB::rollBack();
            return redirect()->back()->withErrors(['Something went wrong']);
        }

    }
}
