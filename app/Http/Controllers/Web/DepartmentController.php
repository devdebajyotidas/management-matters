<?php

namespace App\Http\Controllers\Web;

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

                return redirect()->back()->withInput($request->all())->withErrors($errors, 'department');


            }
        }
        else
        {
            return redirect()->back()->withInput($request->all())->withErrors(['This Department Already exist'], 'department');
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

    public function delete($id)
    {

    }
}
