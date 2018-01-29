<?php

namespace App\Http\Controllers\Web;

use App\Models\Assessment;
use App\Models\Award;
use App\Models\Learner;
use App\Models\Learning;
use App\Models\Organization;
use App\Models\Quiz;
use App\Models\Ticket;
use App\Models\TicketAssignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
