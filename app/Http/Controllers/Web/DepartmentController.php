<?php

namespace App\Http\Controllers\Web;

use App\Models\Assessment;
use App\Models\CostOfNot;
use App\Models\Learner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Models\Department as Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    private $department;

    public function __construct(Department $department)
    {
        $this->middleware('auth');

        $this->department = $department;
    }

    public function index()
    {

    }

    public function store(Request $request, $orgId)
    {
        DB::beginTransaction();

        $data = $request->all();
        $department = Department::where('organization_id','=',$orgId)->where('name','=',trim($data['name']))->get();
        if($department->count() == 0)
        {
            $departmentValidator = Validator::make($data, Department::$rules['create']);

            if ($departmentValidator->passes()) {

                $department = Department::create($data);

                DB::commit();
                return redirect()->back()->with('success', 'Department added successfully');

            }
            else
            {
                DB::rollBack();
                $errors = $departmentValidator->errors();

                return redirect()->back()->withInput($request->all())->withErrors($errors,'department');


            }
        }
        else
        {
            return redirect()->back()->withInput($request->all())->withErrors(['This Department Already exist'],'department');
        }
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $department = Department::findWhere(['name'=>trim($data['name'])]);

        if($department->count() == 0)
        {
            $departmentValidator = Validator::make($data, Department::rules('update'));

            // Check if validation passes
            if ($departmentValidator->passes()) {
                $department = Department::update([
                    'name' => $data['name']
                ],$data['id']);
                session()->flash('success','Department updated successfully');
                $request->session()->flash('success', 'Department updated successfully');
                return redirect()->back();
            }else{
                $error = json_decode($departmentValidator->errors(),TRUE);
                $msg = new MessageBag;
                $msg->add('update',$data['id']);
                $departmentValidator->messages()->merge($msg->messages());
                return redirect()->back()->withInput($data)->withErrors($departmentValidator,'department');
            }
        }else
        {
            $error = new MessageBag;
            $error->add('name','Another department with same name already exists');
            $error->add('update',$data['id']);
            return redirect()->back()->withInput($data)->withErrors($error,'department');
        }
    }

    public function reset(Request $request,$id)
    {
        DB::beginTransaction();

        $action=$request->action;
        $dep=$request->department;

        $reset=0;

        if(!empty($id)){
            if(!empty($dep)){
                if($dep=='all'){
                    $deplist=Department::where('organization_id',$id)->pluck('id')->toArray();
                    $learner=Learner::whereIn('department_id',$deplist)->pluck('id')->toArray();
                }
                else{
                    $learner=Learner::where('department_id',$dep)->pluck('id')->toArray();
                }
            }
            else{
                $learner=null;
            }
            if(!empty($learner)){
                if($action=='assessment'){
                    $data=Assessment::whereIn('learner_id',$learner)->get();
                }
                else{
                    $data=CostOfNot::whereIn('learner_id',$learner)->get();
                }
                if(count($data) > 0){
                    foreach ($data as $d){
                        $d->delete();
                        $reset++;
                    }
                }
                else{
                    $reset=1;
                }

                if($reset > 0){
                    DB::commit();
                    return redirect()->back()->with('success', ucfirst($action).' has been reset successfully');
                }
                else{
                    DB::rollback();
                    return redirect()->back()->withErrors(['Something went wrong']);
                }
            }
            else{
                return redirect()->back()->withErrors(['Learners not avilable']);
            }
        }
        else{
            return redirect()->back()->withErrors(["Could'nt found the department"]);
        }

    }
}
