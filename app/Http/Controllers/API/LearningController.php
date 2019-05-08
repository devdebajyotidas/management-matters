<?php

namespace App\Http\Controllers\API;

use App\Helper\ApiResponse;
use App\Http\Controllers\BaseController;
use App\Models\Department;
use App\Models\Introduction;
use App\Models\Learning;
use App\Models\Quiz;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LearningController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $learnings = Learning::orderBy('title','ASC')->get(['id', 'title', 'description', 'highlights']);

        return $this->success($learnings,'Learnings available');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $data =  ($request->all());
        if ($request->hasFile('image')) {
            $time = time();
            $file = $request->file('image');
            $filename=strtolower(str_replace(' ', '-', $file->getClientOriginalName()));
            $path='attachments/'.$time.$filename;

            if (!Storage::exists('attachments/'.$time)) {
                Storage::makeDirectory('attachments/'.$time);
            }

            Storage::put('attachments/'.$time.'/'.$filename, file_get_contents($file));
            Storage::setVisibility('attachments/'.$time.'/'.$filename, 'public');

            $data['path']='attachments/'.$time.'/'.$filename;
            $data['image'] = 'https://'.Storage::url('attachments/'.$time.'/'.$filename);
        }
        $learning = Learning::create($data);

        if($learning){
            DB::commit();
            return $this->success($learning, 'Module has been created successfully', 201);
        }
        else{
            DB::rollBack();
            return $this->error('Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data['page'] = 'learnings';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
        if(isset(Auth::user()->account) && !empty(Auth::user()->account->department_id)){
            $data['learnings'] = Learning::with(['orgintro'=>function($query){
                $query->where('organization_id',Department::with('organization')->find(Auth::user()->account->department_id)->organization_id)->first();
            }])->find($id);
        }
        else{
            $data['learnings'] = Learning::find($id);
        }

        return view('learnings.single-webview', $data);

    }


    function getLearning($id){
        if(isset(Auth::user()->account) && !empty(Auth::user()->account->department_id)){
            $learning = Learning::with(['orgintro'=>function($query){
                $query->where('organization_id',Department::with('organization')->find(Auth::user()->account->department_id)->organization_id)->first();
            }])->find($id);
        }
        else{
            $learning = Learning::find($id);
        }

        return $this->success($learning, 'Learning is available');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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

        $learning = null;
        $data =  ($request->all());

        if(!isset($data['quiz'])){
            $data['quiz']='';
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time().rand(100,999).".".$file->getClientOriginalExtension();
            if($file->move('uploads/',$name)){
                $data['image']=$name;
            }else{
                $data['image'] = null;
            }
        }
        if(session('role')=='organization'){
            $exist=Introduction::where('learning_id',$id)->where('organization_id',Auth::user()->account_id)->count();
            if($exist > 0){
                $introduction=Introduction::where('learning_id',$id)->where('organization_id',Auth::user()->account_id)->first();
                $introduction->org_introduction=$data['introduction'];
                $status=$introduction->update();
            }
            else{
                $organization['learning_id']=$id;
                $organization['organization_id']=Auth::user()->account_id;
                $organization['org_introduction']=$data['introduction'];
                $status=Introduction::create($organization);
            }

        }
        else{
            $learning=Learning::find($id);
            $learning->fill($data);
            $status=$learning->update();
        }

        if($status){
            DB::commit();
            return $this->success($learning, 'Module has been updated successfully');
        }
        else{
            DB::rollBack();
            return $this->error('Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz_count=0;
        $tickets_count=0;
        if(!empty($id)){
            DB::beginTransaction();

            $learning=Learning::find($id);
            $quiz=Quiz::where('learning_id',$id)->get();
            $tickets=Ticket::where('learning_id',$id)->get();

            if(!empty($learning)){
                if(count($quiz) > 0){
                    foreach ($quiz as $q){
                        $q->delete();
                        $quiz_count++;
                    }
                }
                else{
                    $quiz_count=1;
                }

                if(count($tickets) > 0){
                    foreach ($tickets as $ticket){
                        $ticket->update(['is_archived'=>1]);
                        $ticket->delete();
                        $tickets_count++;
                    }
                }
                else{
                    $tickets_count=1;
                }

                if($learning->delete() && $tickets_count > 0 && $quiz_count > 0){
                    DB::commit();
                    return $this->success($learning, 'Module has been deleted successfully');
                }
            }
            else{
                DB::rollBack();
                return $this->error('Something went wrong!');
            }
        }
        else{
            return $this->error('Could not found the learning module');
        }
    }
}
