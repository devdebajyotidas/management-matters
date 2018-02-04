<?php

namespace App\Http\Middleware;

use Closure;

class TipsCheck
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

        $learner_ids=Auth::user()->account->learners()->pluck('learners.id')->toArray();
        $data['tips'] = Ticket::whereIn('learner_id', $learner_ids)->count();
        return $data;

    }
}
