<?php

namespace App\Http\Controllers\API;

use App\Helper\ApiResponse;
use App\Http\Controllers\BaseController;
use App\Models\Department;
use App\Models\Learning;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            $file = $request->file('image');
            $name = time().rand(100,999).".".$file->getClientOriginalExtension();
            if($file->move('uploads/',$name)){
                $data['image']=$name;
            }else{
                $data['image'] = null;
            }
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
