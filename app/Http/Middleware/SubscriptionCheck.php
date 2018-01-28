<?php

namespace App\Http\Middleware;

use App\Models\Learner;
use App\Models\Subscription;
use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SubscriptionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $uid=Auth::user()->account_id;
        $organization=Learner::with('department.organization')->find($uid);
        if(isset($organization->department->organization->id)){
           $id=$organization->department->organization->id;
        }
        else{
            $id=$uid;
        }
        $subscription=Subscription::where('account_id',$id)->first();
        if(session('role')!='admin'){
            if(isset($subscription)){
                $trial=strtotime('+ '.config('constants.TRIAL_PERIOD'),strtotime($subscription->created_at));
                $today=strtotime(date('Y-m-d H:i:s'));
                if($today > $trial){
                    if(empty($subscription->subcription_id) && $subscription->is_subscribed==0 ){
                        return redirect('message');
                    }
                    else if(!empty($subscription->subcription_id) && $subscription->is_subscribed==0){
                        return redirect('message');
                    }
                }

            }
        }
        return $next($request);
    }
}
