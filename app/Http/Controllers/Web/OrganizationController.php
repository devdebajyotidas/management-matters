<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Learner;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

use App\Models\Organization ;
use App\Models\User as User;


use League\Flysystem\Config;


class OrganizationController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
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
        $data['organizations'] = Organization::withTrashed()->get();
        $data['prefix']  = session('role');

        return view('organizations.index', $data);

    }

    public function show($id)
    {
        $organization = Organization::with(['user','subscription'])->find($id);
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

            $user = User::make($request->get('user'));
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

                app('App\Http\Controllers\Web\SubscriptionController')->subscribe($newreq,$organization->id);
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
        $sub=Subscription::where('account_id',$id)->first();

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
                app('App\Http\Controllers\Web\SubscriptionController')->update($newreq,$sub->subscription_id);

            }
            else{
                if(!empty($data['organization']['card_number']) && !empty($data['organization']['expiry_date'])){
                    $newreq->name_on_card=$data['organization']['name_on_card'];
                    $newreq->card_number=$data['organization']['card_number'];
                    $newreq->expiry_date=$data['organization']['expiry_date'];
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
        $subscription=Subscription::where('account_id',$id)->first();

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
        $subscription=Subscription::where('account_id',$id)->first();
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

            $newreq= new \Illuminate\Http\Request();

            $newreq->name_on_card=$organization->name_on_card;
            $newreq->card_number=$organization->card_number;
            $newreq->expiry_date=$organization->expiry_date;
            $newreq->billing_interval=$subscription->billing_interval;
            $newreq->licenses=$subscription->licenses;

            $response=app('App\Http\Controllers\Web\SubscriptionController')->subscribe($newreq,$organization->id);
            DB::commit();
            return redirect()->back()->with(['success' => 'Organization restored successfully']);
        }
        else
        {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }

    }


}
