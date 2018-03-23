<?php

namespace App\Http\Middleware;

use App\Models\Learner;
use App\Models\Organization;
use App\Models\Subscription;
use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticationCheck
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
        if (session('role') != 'admin') {
            $user = Auth::user();
            $uid = $user->account_id;
            $type=$user->account_type;

            if($type=='App\Models\Organization'){
                $account=Organization::withTrashed()->find($uid);
                $subscription = Subscription::where('account_id', $account->id)->where('account_type','App\Models\Organization')->first();
                if(!is_null($account->deleted_at)){
                    return redirect('suspend');
                }
            }
            else{
                $account=Learner::withTrashed()->with('department.organization')->find($uid);
                $subscription = Subscription::where('account_id', $uid)->where('account_type','App\Models\Learner')->first();
                if(!is_null($account->deleted_at)){
                    return redirect('suspend');
                }
            }

            if($user->is_verified==0){
                return redirect('abort');
            }

            if(isset($subscription->created_at)){
                $trial = strtotime('+ ' . config('constants.TRIAL_PERIOD'), strtotime($subscription->created_at));
                $today = strtotime(date('Y-m-d H:i:s'));
                if ($today >= $trial) {
                    if (is_null($subscription->subcription_id) && $subscription->is_subscribed == 0) {
                        return redirect('message');
                    } else if (!empty($subscription->subcription_id) && $subscription->is_subscribed == 0) {
                        return redirect('message');
                    }
                }
            }
        }
        return $next($request);
    }

}
