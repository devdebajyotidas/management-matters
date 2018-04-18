<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CostOfNot;
use App\Models\Department;
use App\Models\Learner;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Models\Organization ;
use App\Models\User;
use App\Models\Award;
use App\Models\TicketAssignment;
use App\Models\Assessment;
use App\Models\Quiz;
use App\Models\Ticket;

use League\Flysystem\Config;


class OrganizationController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checksub')->only(['dashboard','index','show']);
    }

    public function dashboard()
    {
        $data['page'] = 'dashboard';
        $data['role'] = $this->role;
        $data['prefix'] = $data['prefix'] = '/organization/' . Organization::id;
        return view($this->role.'.dashboard',$data);
    }

    public function index()
    {
        $data['page'] = 'organizations';
        $data['role'] = session('role');
        $data['organizations'] = Organization::withTrashed()->with('subscription')->get();
        $data['prefix']  = session('role');

        return view('organizations.index', $data);

    }

    public function show($id)
    {
        $organization = Organization::withTrashed()->with(['user','subscription'])->find($id);
        $data['page'] = 'organizations';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/' .Auth::user()->account_id;
        $data['organization'] = $organization;

        return view('organizations.profile',$data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $data['organization'] = $request->get('organization');
        $data['user'] = $request->get('user');
        $data['user']['verification_token']= $vtoken=md5(microtime());
        $subscription=$request->get('subscription');
        $subscription['subscription_id']='';
        $subscription['start_date']=date('Y-m-d H:i:s');
        $subscription['status']=1;

        $organizationValidator=Validator::make($data['organization'], Organization::$rules['create']);
        $subscriptionValidator=Validator::make($subscription, Subscription::$rules['create']);
        $userValidator=Validator::make($data['user'], User::$rules['create']);

        if($organizationValidator->passes() && $subscriptionValidator->passes() && $userValidator->passes() )
        {
            if ($request->hasFile('organization.image')) {
                $file = $request->file('organization.image');
                $name = time().rand(100,999).".".$file->getClientOriginalExtension();
                if($file->move('uploads/',$name)){
                    $data['organization']['image'] = $name;
                }else{
                    $data['organization']['image'] = null;
                }
            }

            $user = User::make($data['user']);
            $organization = Organization::create($data['organization']);

            $organization->user()->save($user);
            $user->attachRole('organization');

            $sub = Subscription::make($subscription);

            $organization->subscription()->save($sub);


            if(!empty($data['organization']['card_number']) && !empty($data['organization']['expiry_date']) ){
                $newreq= new \Illuminate\Http\Request();

                $newreq->name_on_card=$organization->name_on_card;
                $newreq->card_number=$organization->card_number;
                $newreq->expiry_date=$organization->expiry_date;
                $newreq->billing_interval=$subscription['billing_interval'];
                $newreq->licenses=$subscription['licenses'];
                $newreq->srole='App\Models\Organization';

                app('App\Http\Controllers\Web\SubscriptionController')->subscribe($newreq,$organization->id);
            }

            $email['logo']=asset('assets/img/mm-logo.png');
            $email['name']=$organization->name;
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
                $email['password']= $data['user']['password'];
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
            return redirect()->back()->with('success', 'Organization added successfully');

        }
        else
        {

            DB::rollBack();
            $errors = $organizationValidator->errors()->merge($subscriptionValidator->errors());

            return redirect()->back()->withInput($request->all())->withErrors($errors);

        }
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

        $data['organization'] = $request->get('organization');
        $data['user'] = $request->get('user');
        $srole='App\Models\Organization';
        $sub=Subscription::where('account_id',$id)->where('account_type',$srole)->first();

        $organizationValidator = Validator::make($data['organization'], Organization::$rules['update']);

        if(trim($data['user']['password']) == '' || $data['user']['password'] == null){
            unset($data['user']['password']);
            unset($data['user']['password_confirmation']);
        }

        $userValidator = Validator::make($data['user'], User::$rules['update']);

        if ($organizationValidator->passes() && $userValidator->passes()) {

            if ($request->hasFile('organization.image')) {
                $file = $request->file('organization.image');
                $name = time().rand(100,999).".".$file->getClientOriginalExtension();
                if($file->move('uploads/',$name)){
                    $data['organization']['image'] = $name;
                }else{
                    $data['organization']['image'] = null;
                }
            }

            $organization = Organization::find($id);

            $organization->fill($data['organization']);
            $organization->update();

            $user = User::find($organization->user->id);
            $user->fill($data['user']);

            $newreq= new \Illuminate\Http\Request();
            if(isset($sub->subscription_id) && !empty($sub->subscription_id)){
                $newreq->card_number=$data['organization']['card_number'];
                $newreq->expiry_date=$data['organization']['expiry_date'];
                $newreq->srole='App\Models\Organization';
                app('App\Http\Controllers\Web\SubscriptionController')->update($newreq,$sub->subscription_id);

            }
            else{
                if(!empty($data['organization']['card_number']) && !empty($data['organization']['expiry_date'])){
                    $newreq->name_on_card=$data['organization']['name_on_card'];
                    $newreq->card_number=$data['organization']['card_number'];
                    $newreq->expiry_date=$data['organization']['expiry_date'];
                    $newreq->srole='App\Models\Organization';
                    app('App\Http\Controllers\Web\SubscriptionController')->subscribe($newreq,$id);
                }
            }

            if($user->update()){
                DB::commit();
                return redirect()->back()->with('success', 'Organization updated successfully');
            }
            else{
                DB::rollBack();
                return redirect()->back()->withErrors(['Something went wrong']);
            }


        } else {
            DB::rollBack();
            $errors = $organizationValidator->errors()->merge($userValidator->errors());
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

        $count=0;

        $organization = Organization::withTrashed()->where('id', $id)->first();
        $learners=$organization->learners()->get();
        $srole='App\Models\Organization';
        $subscription=Subscription::where('account_id',$id)->where('account_type',$srole)->first();

        if($organization->trashed())
        {
            if(count($learners) > 0){
                foreach ($learners as $learner){
                    $learner->forceDelete();
                    $count++;
                }
            }
            else{
                $count=1;
            }

            if($organization->forceDelete() && $count > 0){
                if(isset($subscription->subscripton_id) && !empty($subscription->subscripton_id)){
                    app('App\Http\Controllers\Web\SubscriptionController')->cancel($subscription->subscription_id);
                }

                return redirect()->back()->with(['success' => 'Organization removed successfully']);
            }
            else{
                return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
            }
        }
        else
        {
            if(count($learners) > 0){
                foreach ($learners as $learner){
                    $learner->delete();
                    $count++;
                }
            }
            else{
                $count=1;
            }
            if($organization->delete() && $count > 0){
                if(isset($subscription->subscription_id) && !empty($subscription->subscription_id)){
                    app('App\Http\Controllers\Web\SubscriptionController')->cancel($subscription->subscription_id);
                }
                return redirect()->back()->with(['success' => 'Organization archived successfully']);
            }
            else{
                return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
            }
        }

    }

    public function restore(Request $request, $id){

        DB::beginTransaction();

        $count=0;
        $organization = Organization::withTrashed()->where('id', $id)->first();
        $learners=$organization->learners()->withTrashed()->get();
        $srole='App\Models\Organization';
        $subscription=Subscription::where('account_id',$id)->where('account_type',$srole)->first();
        if(count($learners) > 0){
            foreach ($learners as $learner)
            {
                $learner->restore();
                $count++;
            }
        }
        else{
            $count=1;
        }

        if( $organization->restore() && $count > 0)
        {

            if(isset($subscription)){
                $newreq= new \Illuminate\Http\Request();

                $newreq->name_on_card=$organization->name_on_card;
                $newreq->card_number=$organization->card_number;
                $newreq->expiry_date=$organization->expiry_date;
                $newreq->billing_interval=$subscription->billing_interval;
                $newreq->licenses=$subscription->licenses;
                $newreq->srole='App\Models\Organization';
                $response=app('App\Http\Controllers\Web\SubscriptionController')->subscribe($newreq,$organization->id);
            }

            DB::commit();
            return redirect()->back()->with(['success' => 'Organization restored successfully']);
        }
        else
        {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }

    }

    public function remove(Request $request,$id){
        $count=0;
        $depcount=0;
        $usercount=0;
        $tcount=0;
        $qcount=0;
        $amcount=0;
        $awardcount=0;
        $srole='App\Models\Organization';
        $organization = Organization::withTrashed()->where('id', $id)->first();
        $learners=$organization->learners()->get();
        $subscription=Subscription::where('account_id',$id)->where('account_type',$srole)->first();
        $departments=Department::where('organization_id',$id)->get();
        $user=User::where('account_id',$id)->first();

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

        if(count($learners) > 0 ){
            foreach ($learners as $learner){
                $assessment=Assessment::where('learner_id',$learner->id)->get();
                $award=Award::where('learner_id',$learner->id)->get();
                $quiz=Quiz::where('learner_id',$learner->id)->get();
                $tickets=Ticket::withTrashed()->where('learner_id',$learner->id)->get();
                $userl=User::where('account_id',$learner->id)->get();
                if(count($userl) > 0){
                    foreach ($userl as $le){
                        $le->forceDelete();
                        $usercount++;
                    }
                }
                else{
                    $usercount=1;
                }

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

                if($usercount > 0 && $amcount > 0 && $qcount > 0 && $awardcount > 0 && $tcount > 0){
                    $learner->forceDelete();
                    $count++;
                }

            }
        }
        else{
            $count=1;
        }

        if(count($departments) > 0){
            foreach ($departments as $dep){
                $dep->forceDelete();
                $depcount++;
            }
        }
        else{
            $depcount=1;
        }

        if($organization->forceDelete() && $subdel > 0 && $user->forceDelete() && $count > 0 && $depcount > 0){

            $email['name']=$organization->name;
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
            return redirect()->back()->with(['success' => 'Organization deleted successfully']);
        }
        else{
            DB::rollBack();
            return redirect()->back()->withErrors(['Something went wrong']);
        }

    }

    function updatelicense(Request $request,$id){

        if(!isset($request->action))
            $request->action='upgrade';

        if(session('role')=='organization' && $request->action=='upgrade'){
            return redirect()->intended(url('subscription/'.$id.'/purchase'))->with(['license' => $request->license]);
        }
        $organization=Organization::with('departments.learners')->where('id',$id)->first();
        if(isset($organization->departments)){
            if(count($organization->departments) > 0){
                $learner=0;
                foreach ($organization->departments as $deps){
                    $len=count($deps->learners);
                    $learner+=$len;
                }
            }
            else{
                $learner=0;
            }
        }
        else{
            $learner=0;
        }


        $subscription=Subscription::where('account_id',$id)->where('account_type','App\Models\Organization')->first();

        if(empty($subscription)){
            return redirect()->back()->withErrors(['Subscription not found']);
        }

        if(is_null($subscription->subscription_id)){
            return redirect()->back()->withErrors(['Please subscribe before changing your license']);
        }

        if($request->action=='upgrade'){
            $licenses=$subscription->licenses + $request->license;
        }
        else{
            $licenses = $subscription->licenses - $request->license;
            if($licenses > 0) {
                if ($licenses < $learner) {
                    return redirect()->back()->withErrors(['You have more active learners than your licenses']);
                }
            }else{
                return redirect()->back()->withErrors(['You must have license more than 0']);
            }

        }
        if(!empty($subscription->subscription_id)) {
            $newreq= new \Illuminate\Http\Request();
            $newreq->amount=$amount=$licenses*config('constants.BASE_PRICE');
            $result=app('App\Http\Controllers\Web\SubscriptionController')->update($newreq,$subscription->subscription_id);
            if($result){
                $subscription->update(['licenses'=>$licenses]);
                return redirect()->back()->with(['success' => 'Licenses has been updated']);
            }
            else{
                return redirect()->back()->withErrors(['Something went wrong']);
            }

        }else{
            return redirect()->back()->withErrors(['Subscription not available']);
        }
    }

    function resetassessment($id){
        DB::beginTransaction();

        $amcount=0;
        $organization = Organization::withTrashed()->where('id', $id)->first();
        $learners=$organization->learners()->get();
        if(count($learners) > 0 ) {
            foreach ($learners as $learner) {
                $assessment = Assessment::where('learner_id', $learner->id)->get();
                if(count($assessment) > 0){
                    foreach ($assessment as $am){
                        $am->delete();
                        $amcount++;
                    }
                }
                else{
                    $amcount=1;
                }
            }
        }
        else{
            return redirect()->back()->with(['success' => 'Assessment has been reset']);
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
        $organization = Organization::withTrashed()->where('id', $id)->first();
        $learners=$organization->learners()->get();
        if(count($learners) > 0 ) {
            foreach ($learners as $learner) {
                $cost = CostOfNot::where('learner_id', $learner->id)->get();
                if(count($cost) > 0){
                    foreach ($cost as $am){
                        $am->delete();
                        $amcount++;
                    }
                }
                else{
                    $amcount=1;
                }
            }
        }
        else{
            return redirect()->back()->with(['success' => 'Cost of not managing better has been reset']);
        }

        if($amcount > 0){
            DB::commit();
            return redirect()->back()->with(['success' => 'Cost of not has been reset']);
        }
        else{
            DB::rollBack();
            return redirect()->back()->withErrors(['Something went wrong']);
        }
    }

    function resetassessmentall(){
        DB::beginTransaction();

        $amcount=0;
        $lamcount=0;
        $organizations=Organization::withTrashed()->get();
        $learners=Learner::withTrashed()->get();

        if(count($organizations) > 0){
            foreach ($organizations as $organization){
                $orglearners=$organization->learners()->withTrashed()->get();
                if(count($orglearners) > 0){
                    foreach ($orglearners as $olearner) {
                        $oassessment = Assessment::where('learner_id', $olearner->id)->get();
                        if(!empty($oassessment) && count($oassessment) > 0){
                            foreach ($oassessment as $oam){
                                $oam->delete();
                                $amcount++;
                            }
                        }
                        else{
                            $amcount=1;
                        }
                    }
                }
                else{
                    $amcount=1;
                }
            }
        }
        else{
            $amcount=1;
        }

        if(count($learners) > 0){
            foreach ($learners as $learner) {
                $assessment = Assessment::where('learner_id', $learner->id)->get();
                if(!empty($assessment) && count($assessment) > 0){
                    foreach ($assessment as $am){
                        $am->delete();
                        $lamcount++;
                    }
                }
                else{
                    $lamcount=1;
                }
            }
        }
        else{
            $lamcount=1;
        }


        if($amcount > 0 && $lamcount > 0){
            DB::commit();
            return redirect()->back()->with(['success' => 'Assessment has been reset']);
        }
        else{
            DB::rollBack();
            return redirect()->back()->withErrors(['Something went wrong']);
        }

    }

    function resetconmball(){
        DB::beginTransaction();

        $amcount=0;
        $lamcount=0;
        $organizations=Organization::withTrashed()->get();
        $learners=Learner::withTrashed()->get();

        if(count($organizations) > 0){
            foreach ($organizations as $organization){
                $orglearners=$organization->learners()->withTrashed()->get();
                if(count($orglearners) > 0){
                    foreach ($orglearners as $olearner) {
                        $oassessment = CostOfNot::where('learner_id', $olearner->id)->get();
                        if(!empty($oassessment) && count($oassessment) > 0){
                            foreach ($oassessment as $oam){
                                $oam->delete();
                                $amcount++;
                            }
                        }
                        else{
                            $amcount=1;
                        }
                    }
                }
                else{
                    $amcount=1;
                }
            }
        }
        else{
            $amcount=1;
        }

        if(count($learners) > 0){
            foreach ($learners as $learner) {
                $assessment = CostOfNot::where('learner_id', $learner->id)->get();
                if(!empty($assessment) && count($assessment) > 0){
                    foreach ($assessment as $am){
                        $am->delete();
                        $lamcount++;
                    }
                }
                else{
                    $lamcount=1;
                }
            }
        }
        else{
            $lamcount=1;
        }


        if($amcount > 0 && $lamcount > 0){
            DB::commit();
            return redirect()->back()->with(['success' => 'Cost of not managing better has been reset']);
        }
        else{
            DB::rollBack();
            return redirect()->back()->withErrors(['Something went wrong']);
        }

    }


    /*Delete Department*/
    function deleteDepartment($id){
        if(isset($id) && !empty($id)){
            $exist=Learner::where('department_id',$id)->exists();
            if($exist){
                return redirect()->back()->withErrors(['Learners must be removed from this Department before it can be deleted.']);
            }
            else{
                $department=Department::find($id);
                $delete=$department->delete();
                if($delete){
                    return redirect()->back()->with(['success' => 'Department has been  deleted']);
                }
                else{
                    return redirect()->back()->withErrors(['Something went wrong']);
                }
            }
        }
        else{
            return redirect()->back()->withErrors(['No department selected']);
        }
    }
}
