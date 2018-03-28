<?php

namespace App\Http\Controllers\Web;

use App\Models\Assessment;
use App\Models\Award;
use App\Models\CostOfNot;
use App\Models\Learner;
use App\Models\Learning;
use App\Models\Organization;
use App\Models\Quiz;
use App\Models\Ticket;
use App\Models\TicketAssignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checksub');
    }

    public function index()
    {

        $data['page'] = 'dashboard';
        $data['role'] = session('role');
        $data['prefix']  = session('role');

        $learnings = Learning::count();
        $outstandingTickets = Ticket::where('is_completed', '=', 0);
        $completedTickets = Ticket::where('is_completed', '=', 1);
        $archivedTickets = Ticket::where('is_archived', '=', 1);
        $ticketAssignments = TicketAssignment::where('id', '>', 0);
        $awards = Award::where('id', '>', 0);
        $assessments = Assessment::where('id', '>', 0);
        $quiz = Quiz::where('id', '>', 0);

        $now = Carbon::now();
        $resetDate = Carbon::createFromFormat('d/m/Y', '01/01/'. $now->year);

        $orgs = Organization::with(['learners.costs'])->get();


        if(session('role')=='admin'){
            $data['learnings'] = $learnings;
            $data['outstandingTickets'] = $outstandingTickets->count();
            $data['completedTickets'] = $completedTickets->count();
            $data['archivedTickets'] = $archivedTickets->count();
            $data['ticketAssignments'] = $ticketAssignments->count();
            $data['awards'] = $awards->count();
            $data['assessments'] = $assessments->count();
            $data['quiz'] = $quiz->count();
            $data['organizations'] = Organization::count();
            $data['learners'] = Learner::count();

            $cost = [];
            foreach ($orgs as  $org)
            {
                $cost[$org->name] = 0;
                foreach ($org->learners as $learner)
                {
                    $temp = $learner->costs;
                    if(count($temp))
                        $cost[$org->name] += $temp[count($temp) - 1]->total;

//                    foreach ($learner->costs as $c)
//                    {
//                    if($now->gt($resetDate))
//                        $cost[$org->name] += $c->total;
//                    }
                }
            }

            $data['cost'] = $cost;

//            return view('admin.dashboard', $data);
        }
        else if(session('role')=='organization'){
            $learnersId = Auth::user()->account->learners->pluck('id')->toArray();

            $outstandingTickets = $outstandingTickets->whereIn('learner_id', $learnersId);
            $completedTickets = $completedTickets->whereIn('learner_id', $learnersId);
            $archivedTickets = $archivedTickets->whereIn('learner_id', $learnersId);
            $awards = $awards->whereIn('learner_id', $learnersId);
            $assessments = $assessments->whereIn('learner_id', $learnersId);
            $quiz = $quiz->whereIn('learner_id', $learnersId);
            $ticketAssignments = $ticketAssignments->whereHas('ticket', function ($query) use ($learnersId){
                $query->whereIn('learner_id', $learnersId);
            });

            $now = Carbon::now();
            $resetDate = Carbon::createFromFormat('d/m/Y', '01/01/'. $now->year);
            $data['cost'] = CostOfNot::whereIn('learner_id', $learnersId)->whereDate('created_at', '>=', $resetDate)->select('id', 'total', 'created_at')
                ->get()
                ->groupBy(function($val) {
                    return Carbon::parse($val->created_at)->format('M');
                });

            $cost = [];
            foreach ($data['cost'] as $month => $c)
            {
                $cost[$month] = 0;
                if(count($c))
                {
                    $cost[$month] += $c[count($c) -1]->total;
                }
//                foreach ($c as $c2)
//                {
//                    $cost[$month] += $c2->total;
//                }
            }
            $data['cost'] = $cost;
//            dd(, CostOfNot::whereIn('learner_id', $learnersId)->pluck('total', 'created_at'));

            $data['learnings'] = $learnings;
            $data['outstandingTickets'] = $outstandingTickets->count();
            $data['completedTickets'] = $completedTickets->count();
            $data['archivedTickets'] = $archivedTickets->count();
            $data['ticketAssignments'] = $ticketAssignments->count();
            $data['awards'] = $awards->count();
            $data['assessments'] = $assessments->count();
            $data['quiz'] = $quiz->count();
            $data['licenses'] = isset(Auth::user()->account->subscription) ? Auth::user()->account->subscription->licenses : 0;
            $data['learners'] = Auth::user()->account->learners()->count();
//            return view('organizations.dashboard', $data);
        }
        else{
            $learnersId = Auth::user()->account_id;

            $outstandingTickets = $outstandingTickets->where('learner_id', '=', $learnersId);
            $completedTickets = $completedTickets->where('learner_id', '=', $learnersId);
            $archivedTickets = $archivedTickets->where('learner_id', '=', $learnersId);
            $awards = $awards->where('learner_id', '=', $learnersId);
            $assessments = $assessments->where('learner_id', '=', $learnersId);
            $quiz = $quiz->where('learner_id', '=', $learnersId);
            $ticketAssignments = $ticketAssignments->whereHas('ticket', function ($query) use ($learnersId){
                $query->where('learner_id', '=', $learnersId);
            });


            $data['cost'] = Auth::user()->account->costs()->pluck('total', 'created_at');

            $data['learnings'] = $learnings;
            $data['outstandingTickets'] = $outstandingTickets->count();
            $data['completedTickets'] = $completedTickets->count();
            $data['archivedTickets'] = $archivedTickets->count();
            $data['ticketAssignments'] = $ticketAssignments->count();
            $data['awards'] = $awards->count();
            $data['assessments'] = $assessments->count();
            $data['quiz'] = $quiz->count();
            $data['organizations'] = Organization::count();
            $data['learners'] = Learner::count();
//            return view('dashboard', $data);
        }

//        dd($data['cost']);

        return view('dashboard', $data);
    }

    public function admin()
    {
        $data['page'] = 'dashboard';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
        return view('admin.dashboard', $data);
    }

    public function learner()
    {
        $data['page'] = 'dashboard';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/' .Auth::user()->account_id;
        return view('admin.dashboard', $data);
    }

    public function organization()
    {
        $data['page'] = 'dashboard';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/' .Auth::user()->account_id;
        return view('admin.dashboard', $data);
    }

}
