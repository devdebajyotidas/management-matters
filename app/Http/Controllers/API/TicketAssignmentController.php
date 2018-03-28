<?php

namespace App\Http\Controllers\API;

use App\Models\Award;
use App\Models\TicketAssignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TicketAssignmentController extends Controller
{

    public function store(Request $request)
    {
        DB::beginTransaction();

        $data['assignment'] = $request->all();

        $assignment = TicketAssignment::create($data['assignment']);

        if ($assignment) {
            DB::commit();
            return response()->json([ 'success' => true, 'message'=>'Ticket has been assigned successfully','award'=>null]);
        } else {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'award' => null]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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

        $awstatus = null;
        $data['assignment'] = $request->all();
        $assignemnt = TicketAssignment::find($id);

//        $result = $assignemnt->update(['note' => $data['assignment']['note']]);

        $assignemnt->fill($data['assignment']);
        $result = $assignemnt->save();


        if ($result)
        {
            $activity = TicketAssignment::where('ticket_id', $id)->whereNotNull('note')->get()->count();
            if ($activity >= 5)
            {
                $ticket = $assignemnt->ticket;
                $award['learner_id'] = $ticket->learner->id;
                $award['title'] = "Activity award for " . $ticket->title;
                $award['description'] = $awstatus = 'activity';
                $message = "You've earned a better management  badge";
                $award = Award::create($award);
            } else
            {
                $award = null;
                $message = "Ticket's activity has been updated";
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => $message, 'award' => $award]);
        } else {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'award' => null]);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    function delete($id)
    {
        DB::beginTransaction();

        if (!empty($id)) {
            $assignemnt = TicketAssignment::find($id);
            if ($assignemnt->forceDelete()) {
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Assignment has been removed', 'award' => null]);
            } else {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Something went wrong!', 'award' => null]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'award' => null]);
        }
    }
}
