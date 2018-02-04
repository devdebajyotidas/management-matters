<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Learner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\CostOfNot;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = Storage::disk('public')->get('CostOfNot/content.txt');
        $cst=CostOfNot::where('learner_id',Auth::user()->account_id)->orderBy('created_at', 'desc')->first();
        if(!isset($cst)){
            $cost['name']=array("Enter description 1","Enter description 2","Enter description 3","Enter description 4","Enter description 5","Enter description 6");
            $cost['hourly_wage']=$cost['emp_num']=$cost['lost_hours']=array('0','0','0','0','0','0');
        }
        else{
            $cost['name']=json_decode($cst->name);
            $cost['hourly_wage']=json_decode($cst->hourly_wage);
            $cost['emp_num']=json_decode($cst->emp_num);
            $cost['lost_hours']=json_decode($cst->lost_hours);
        }
        return view('cost', ['page' => 'cost', 'role' => session('role'), 'content' => $content,'cost'=>$cost]);
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
    public function store(Request $request){

       DB::beginTransaction();

        $data['cost']=$request->all();
        $costValidator = Validator::make($data['cost'], CostOfNot::$rules['create']);

        if($costValidator->passes()){

            $data['cost']['learner_id']=Auth::user()->account_id;
            $result = CostOfNot::create($data['cost']);
            if($result){

                DB::commit();
                return redirect()->back()->with('success', 'Cost calculation has been saved');
            }
            else{
                DB::rollBack();
                return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
            }
        }
        else{
            DB::rollBack();
            $errors = $costValidator->errors();
            return redirect()->back()->withInput($request->all())->withErrors($errors);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $content = Storage::disk('public')->get('CostOfNot/content.txt');

        return view('cost-edit', ['page' => 'cost', 'role' => session('role'), 'content' => $content]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $content = $request->get('content');
        Storage::disk('public')->put('CostOfNot/content.txt', $content);
        return redirect()->back()->with('success', 'Cost calculation has been saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
