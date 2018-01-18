<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Learner;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('home');
    }
    
    public function home()
    {
        $user = Auth::user();
        if($user)
        {
            return redirect()->intended('dashboard');

        }else{
            return redirect()->intended('/');
        }
    }

    public function cost()
    {
        return view('cost', ['page' => 'cost', 'role' => session('role')]);
    }

    public function restricted()
    {
        return view('errors.403');
    }

    public function profile(){
        $data['page'] = 'profile';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
         if(session('role')=='organization'){
             $data['organization']=Organization::with(['subscription'])->find(Auth::user()->account_id);
             return view('profile.organization', $data);
         }
         elseif(session('role')=='learner'){
             $data['learner']=Learner::with(['subscription'])->find(Auth::user()->account_id);
             return view('profile.learner', $data);
         }
    }

    public function cancelsub($subid){
        $response=app('App\Http\Controllers\Web\SubscriptionController')->cancel($subid);
        if($response){
            return redirect()->intended(url('logout'));
        }
        else{
            return redirect()->back()->withErrors(['Something went wrong']);
        }
    }

    public function removeaccount(){
        DB::beginTransaction();
        if(session('role')=='learner'){
            $learner = Learner::withTrashed()->where('id', Auth::user()->account_id)->first();
            $subscription=Subscription::where('account_id',Auth::user()->account_id)->first();
            $user=User::where('account_id',Auth::user()->account_id)->first();
            if(!empty($subscription->subscription_id)){
                app('App\Http\Controllers\Web\SubscriptionController')->cancel($subscription->subscription_id);
            }
            if($subscription->forceDelete() && $user->forceDelete() && $learner->forceDelete()){
                DB::commit();

                return redirect()->intended(url('logout'));
            }
            else{
                DB::rollBack();
                return redirect()->back()->withErrors(['Something went wrong']);
            }
        }
        elseif(session('role')=='organization'){
            $count=0;
            $organization = Organization::withTrashed()->where('id',Auth::user()->account_id)->first();
            $learners=$organization->learners()->get();
            $subscription=Subscription::where('account_id',Auth::user()->account_id)->first();
            $user=User::where('account_id',Auth::user()->account_id)->first();
            if(!empty($subscription->subscription_id)){
                app('App\Http\Controllers\Web\SubscriptionController')->cancel($subscription->subscription_id);
            }

            if(count($learners) > 0 ){
                foreach ($learners as $learner){
                    $learner->forceDelete();
                    $count++;
                }
            }
            else{
                $count=1;
            }

            if($organization->forceDelete() && $subscription->forceDelete() && $user->forceDelete() && $count > 0){
                DB::commit();
                return redirect()->intended(url('logout'));
            }
            else{
                DB::rollBack();
                return redirect()->back()->withErrors(['Something went wrong']);
            }
        }
    }
}
