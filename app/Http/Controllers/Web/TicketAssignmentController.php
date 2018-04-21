<?php

namespace App\Http\Controllers\Web;

use App\Models\TicketAssignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Award;

class TicketAssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checksub');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $data['assignment'] = $request->get('assignment');
        $assignment = TicketAssignment::create($data['assignment']);

        if($assignment){

            DB::commit();
            return redirect()->back()->with('success', 'Ticket has been assigned successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $awstatus=null;
        $data['assignment'] = $request->get('assignment');
        $data['assignment']['note']=str_replace(array("\r\n", "\n", "\r"),' ',$data['assignment']['note']);
        $data['ticket'] = $request->get('ticket');
        $assignemnt = TicketAssignment::find($id);
        $result=$assignemnt->update(['note'=>$data['assignment']['note']]);
        if($request->submit){
            $activity=TicketAssignment::where('ticket_id',$data['assignment']['ticket_id'])->whereNotNull('note')->whereDate('created_at','=',date('Y-m-d'))->get()->count();
            if($activity==5){
                $award['learner_id'] = Auth::user()->account_id;
                $award['title'] = "Activity award for " . $data['ticket']['title'] ;
                $award['description']=$awstatus='activity';
                $message="Activity Award!  Keep up the good work!";
                Award::create($award);
            }
            else{
                $message="Ticket's activity has been updated";
            }
        }
        else{
            $assignemnt->fill($data['assignment']);
            $result=$assignemnt->save();
            $message="Ticket has been assigned to a new date";
        }
        if($result){
            DB::commit();
            return redirect()->back()->with(['success'=>$message,'award'=>$awstatus]);
        }
        else{
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    function delete($id){
        DB::beginTransaction();

        if(!empty($id)){
            $assignemnt = TicketAssignment::find($id);
            if($assignemnt->forceDelete()){
                DB::commit();
                return redirect()->back()->with('success', 'Assignment has been removed');
            }
            else{
                DB::rollBack();
                return redirect()->back()->withErrors(['Something went wrong!']);
            }
        }
        else{
            return redirect()->back()->withErrors(['Something went wrong!']);
        }
    }
}
