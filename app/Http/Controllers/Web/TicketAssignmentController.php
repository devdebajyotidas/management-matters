<?php

namespace App\Http\Controllers\Web;

use App\Models\TicketAssignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

        $data['assignment'] = $request->get('assignment');
        $assignemnt = TicketAssignment::find($id);
        $assignemnt->fill($data['assignment']);
        $assignemnt->save();
        if($assignemnt->save()){
            DB::commit();
            return redirect()->back()->with('success', 'Target date has been changed');
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
}
