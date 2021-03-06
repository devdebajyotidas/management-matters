<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Award;
use App\Models\Department;
use App\Models\Organization;
use App\Models\TicketAssignment;
use App\Models\Ticket;
use App\Models\Learning;


class TicketController extends Controller
{
    public function index($learnerId)
    {
        $id = $learnerId;

        $data['page'] = 'tickets';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/'. $id;

        $data['learnerId'] = $id;
        $data['learnings'] = Learning::all(['id','title']);

        $data['tickets'] = Ticket::with(['assignments', 'learning'])->where(['learner_id' => $id])->get();
//        $assignments = TicketAssignment::with(['ticket' => function($query){
//            $query->where(['learner_id' => Auth::user()->account_id]);
//        }])->get();
//
//        $data['assignments'] = [];
//        foreach ($assignments as $assignment)
//        {
//            if(!empty($assignment->ticket)){
//                $assignment->title = $assignment->ticket->title;
//                $assignment->learner_id = $assignment->ticket->learner_id;
//                $assignment->learning_id = $assignment->ticket->learning_id;
//                $assignment->impact_level = $assignment->ticket->impact_level;
//                $assignment->is_archived = $assignment->ticket->is_archived;
//                $assignment->is_completed = $assignment->ticket->is_completed;
//
//                $data['assignments'][] = $assignment;
//            }
//
//        }

        return response()->json($data['tickets']);
    }

    public function events(){
        $id = Auth::user()->account_id;

        $data['page'] = 'tickets';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/'. $id;
        $data['assignments']=TicketAssignment::with(['ticket'=>function($query){
            $query->where(['learner_id' => Auth::user()->account_id]);
        }])->get();
        return view('tickets.events', $data);
    }

    public function store(Request $request, $learnerId)
    {

        DB::beginTransaction();

        $data['ticket'] = $request->all();

        $ticket = Ticket::create($data['ticket']);

        if($ticket)
        {
            DB::commit();
            return response()->json(Ticket::with(['assignments','learning'])->where(['learner_id' => $learnerId])->get());
        }
        else{
            DB::rollBack();
            return response()->json([]);
        }

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $data['ticket'] = $request->get('ticket');
        $data['assignments']=$request->get('assignments');
        $ticket = Ticket::find($id);

        if(isset($data['ticket']['is_archived']) && $data['ticket']['is_archived'] == 1)
        {
            $ticket->is_archived=1;
        }

        if(isset($data['ticket']['is_completed']) && $data['ticket']['is_completed'] == 1)
        {
            $ticket->is_completed=1;
            $award['learner_id'] = $data['ticket']['learner_id'];
            $award['title'] = "Successfully completed Ticket - " . $data['ticket']['title'] ;
            $award = Award::create($award);
        }
        else
        {
            $award = null;
        }

        if($ticket->save())
        {
            if (isset($data['assignments']))
            {
                foreach ($data['assignments'] as $assignment)
                {
                    if(!isset($assignment['ticket_id']))
                        $assignment['ticket_id'] = $id;

                    if(isset($assignment['id']) && $assignment['id'] > 0)
                    {
                        $ticketAssignemnt = TicketAssignment::find($assignment['id']);
                        $ticketAssignemnt->fill($assignment);
                    }
                    else
                    {
                        $ticketAssignemnt = TicketAssignment::make($assignment);
                    }
//                $assignemnt->note = $assignment['note'];
                    $ticketAssignemnt->save();
                }
            }

            DB::commit();
            return response()->json(
                [
                'ticket' => $ticket->load('assignments'),
                'award' => $award,
                'error' => ''
            ]);
        }
        else
        {
            DB::rollBack();
            return response()->json([
                'ticket' => null,
                'award' => null,
                'error' => 'Something went wrong!'
            ]);
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
            return response()->json([
                'ticket' => true,
                'award' => null,
                'error' => ''
            ]);
        }
        else{
            DB::rollBack();
            return response()->json([
                'ticket' => null,
                'award' => null,
                'error' => 'Something went wrong!'
            ]);
        }
    }
}
