<?php

namespace App\Http\Controllers\Web;


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
        

    }

    public function index()
    {
        $data['page'] = 'learnings';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/' . Auth::user()->account_id;
        $data['learnings'] = Learning::all();

        return view('learnings.index', $data);
    }

    public function show(Request $request, $id)
    {
        $data['page'] = 'learnings';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
        $data['learnings'] = Learning::find($id);

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
        $data['learning'] = Learning::find($id);

        return view('learnings.create', $data);
    }

    public function update(Request $request,$id)
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
        $learning=Learning::find($id);
        $learning->fill($data);

        if($learning->update()){
            DB::commit();
            return redirect()->back()->with('success', 'Module has been updated successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }

    }
}
