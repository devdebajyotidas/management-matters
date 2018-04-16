<?php

namespace App\Http\Controllers\Web;


use App\Models\Department;
use App\Models\Introduction;
use App\Models\Learner;
use App\Models\Organization;
use App\Models\Quiz;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Learning;

class LearningController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checksub');
    }

    public function index()
    {
        $data['page'] = 'learnings';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/' . Auth::user()->account_id;

        $learnings = Learning::orderBy('title','ASC')->get();
        $data['learnings'] = $learnings;
//        $size = ceil($learnings->count() / 3);
//        $chunks = $learnings->chunk($size);

//        $data['learningBundle'] = $chunks;

        return view('learnings.index', $data);
    }

    public function show(Request $request, $id)
    {
        $data['page'] = 'learnings';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
        if(!empty(Auth::user()->account->department_id)){
            $data['learnings'] = Learning::with(['orgintro'=>function($query){
                $query->where('organization_id',Department::with('organization')->find(Auth::user()->account->department_id)->organization_id)->first();
            }])->find($id);
        }
        elseif(session('role')=='organization'){
            $data['learnings'] = Learning::with(['orgintro'=>function($query){
                $query->where('organization_id',Auth::user()->account_id)->first();
            }])->find($id);
        }
        else{
            $data['learnings'] = Learning::find($id);
        }

        return view('learnings.single', $data);
    }

    public function create()
    {
        $data['page'] = 'learnings';
        $data['role'] = session('role');
        $data['prefix']  = session('role');

        return view('learnings.create', $data);
    }

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
            return redirect()->back()->with('success', 'Module has been created successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }
    }

    public function edit($id)
    {
        $data['page'] = 'learnings';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
        if(session('role')=='organization'){
            $data['learning'] = Learning::with(['orgintro'=>function($query){
                $query->where('organization_id',Auth::user()->account_id)->first();
            }])->find($id);
        }
        else{
            $data['learning'] = Learning::find($id);
        }
        return view('learnings.create', $data);
    }

    public function update(Request $request,$id)
    {
        DB::beginTransaction();

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
            return redirect()->back()->with('success', 'Module has been updated successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }

    }

    function delete($id){
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
                    return redirect()->intended(url('learnings'))->with('success', 'Module has been deleted successfully');
                }
            }
            else{
                DB::rollBack();
                return redirect()->back()->withErrors(['Something went wrong!']);
            }
        }
        else{
            return redirect()->back()->withErrors(['Could not found the learning module']);
        }
    }
}
