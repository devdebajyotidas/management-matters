<?php

namespace App\Http\Controllers\Web;

use App\Models\Award;
use App\Models\Department;
use App\Models\Learner;
use App\Models\Organization;
use App\Models\TicketAssignment;
use App\Http\Middleware\AuthenticationCheck;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Ticket;
use App\Models\Learning;
use App\Models\User;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checksub');

    }

    public function index()
    {
        $id = Auth::user()->account_id;

        $data['page'] = 'tickets';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/'. $id;

        $data['learnerId'] = $id;
        $data['learnings'] = Learning::orderBy('title')->get(['id','title']);

        if(session('role') == 'admin'){
            $data['organizations'] = Organization::all(['id','name']);
            $data['tickets'] = Ticket::with(['assignments','learner.department.organization'])->get();
            return view('tickets.index', $data);
        }


        if(session('role') == 'organization')
        {
            $filter=isset($_GET['filter']) ? $_GET['filter'] : '';
            $today=Carbon::today()->toDateString();
            $week=Carbon::now()->subWeek(1)->toDateString();
            $month=Carbon::now()->subMonth(1)->toDateString();

            $data['departments'] = Department::where('organization_id',$id)->get(['id','name']);
            $learner_ids=Auth::user()->account->learners()->pluck('learners.id')->toArray();
            if($filter=='today'){
                $data['tickets'] = Ticket::with(['assignments','learner.department.organization'])->whereIn('learner_id', $learner_ids)->whereDate('created_at','=',$today)->get();
            }
            elseif($filter=='week'){
                $data['tickets'] = Ticket::with(['assignments','learner.department.organization'])->whereIn('learner_id', $learner_ids)->whereDate('created_at','>=',$week)->get();
            }
            elseif($filter=='month'){
                $data['tickets'] = Ticket::with(['assignments','learner.department.organization'])->whereIn('learner_id', $learner_ids)->whereDate('created_at','>=',$month)->get();
            }
            else{
                $data['tickets'] = Ticket::with(['assignments','learner.department.organization'])->whereIn('learner_id', $learner_ids)->get();
            }
            return view('tickets.index', $data);
        }

        if(session('role') == 'learner'){
            $data['tickets'] = Ticket::with(['assignments'])->where(['learner_id' => $id])->get();
            $assignments = TicketAssignment::with(['ticket' => function($query){
                $query->where(['learner_id' => Auth::user()->account_id]);
            }])->get();

            foreach ($assignments as $assignment)
            {
                if(!empty($assignment->ticket)){
                    $assignment->title = $assignment->ticket->title;
                    $assignment->learner_id = $assignment->ticket->learner_id;
                    $assignment->learning_id = $assignment->ticket->learning_id;
                    $assignment->impact_level = $assignment->ticket->impact_level;
                    $assignment->is_archived = $assignment->ticket->is_archived;
                    $assignment->is_completed = $assignment->ticket->is_completed;
                    $data['assignments'][] = $assignment;
                }

            }

            return view('tickets.calendar', $data);
        }
    }

    public function events(){
        $id = Auth::user()->account_id;

        $data['page'] = 'tickets';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/'. $id;

        $data['tickets'] = Ticket::with(['assignments'])->where(['learner_id' => $id])->get();
        return view('tickets.events', $data);
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        
        $data['ticket'] = $request->get('ticket');

        $ticket = Ticket::create($data['ticket']);

        if($ticket){
            DB::commit();
            return redirect()->back()->with('success', 'A ticket has been created successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $awstatus=null;
        $type=NULL;
        $data['ticket'] = $request->get('ticket');
        $ticket=Ticket::find($id);

        if(isset($data['ticket']['archive'])){
            $type="archived";
            $ticket->is_archived=1;
        }

        if(isset($data['ticket']['complete']))
        {
            $type="completed";

            $ticket->is_completed=1;
            $award['learner_id'] = Auth::user()->account_id;
            $award['title'] = "Successfully completed Ticket - " . $data['ticket']['title'] ;
            $award['description']=$awstatus='ticket_complete';

            Award::create($award);

        }

        if(!empty($type) && $type=='completed'){
            $message="Successful Ticket Completion!  Keep  up the good work!";
        }
        else if(!empty($type)){
            $message="Ticket has been ".$type." successfully";
        }
        else{
            $message="Ticket has been updated successfully";
        }


        $ticket->title=$data['ticket']['title'];
        $ticket->impact_level=$data['ticket']['impact_level'];
        $ticket->learning_id=$data['ticket']['learning_id'];

        if($ticket->save()){

            DB::commit();

            return redirect()->back()->with(['success'=>$message,'award'=>$awstatus]);
        }
        else{
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }

    }

    public function delete(Request $request, $id)
    {
        DB::beginTransaction();

        $count=0;
        $ticket=Ticket::find($id);
        $assigments=$ticket->assignments()->get();

        if(count($assigments) > 0){
            foreach ($assigments as $assignment){
                $assignment->delete();
                $count++;
            }
        }
        else{
            $count=1;
        }

        if($ticket->delete() && $count > 0){

            DB::commit();
            return redirect()->back()->with('success', 'Ticket has been removed');
        }
        else{
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }
    }
}