<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Middleware\SubscriptionCheck;
use App\Models\Assessment;
use App\Models\Award;
use App\Models\Department;
use App\Models\Organization;
use App\Models\Quiz;
use App\Models\Subscription;
use App\Models\Ticket;
use App\Models\TicketAssignment;
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
        $this->middleware('checksub')->only('cost');
    }
    
    public function home()
    {
        $user = Auth::user();
        if($user)
        {
            return redirect()->intended('dashboard');

        }else{
            return redirect()->intended('login')->withErrors(['Incorrect email or password']);
        }
    }

    public function message(){

        return view('errors.subscription');

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

        $tcount=0;
        $qcount=0;
        $amcount=0;
        $awardcount=0;


        if(session('role')=='learner'){
            $learner = Learner::withTrashed()->where('id', Auth::user()->account_id)->first();
            $subscription=Subscription::where('account_id',Auth::user()->account_id)->first();
            $user=User::where('account_id',Auth::user()->account_id)->first();
            $assessment=Assessment::where('learner_id',Auth::user()->account_id)->get();
            $award=Award::where('learner_id',Auth::user()->account_id)->get();
            $quiz=Quiz::where('learner_id',Auth::user()->account_id)->get();
            $tickets=Ticket::withTrashed()->where('learner_id',Auth::user()->account_id)->get();

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
            if($subdel > 0 && $user->forceDelete() && $learner->forceDelete() && $tcount > 0 && $qcount > 0 && $awardcount > 0 && $amcount > 0){
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
            $depcount=0;
            $usercount=0;

            $organization = Organization::withTrashed()->where('id',Auth::user()->account_id)->first();
            $learners=$organization->learners()->get();
            $departments=Department::where('organization_id',Auth::user()->account_id)->get();
            $subscription=Subscription::where('account_id',Auth::user()->account_id)->first();
            $user=User::where('account_id',Auth::user()->account_id)->first();


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
