<?php

namespace App\Http\Controllers\Web;

use App\Models\Award;
use App\Models\Department;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AwardController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checksub');
    }

    public function index()
    {
        $data['page'] = 'awards';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
        if(session('role')=='admin'){
            $data['organizations']=Organization::all(['id','name']);
            $data['awards']=Award::with('learner')->orderBy('created_at', 'desc')->get();

            return view('awards.index', $data);
        }
        else if(session('role')=='organization'){
            $data['departments'] = Auth::user()->account->departments;

            $data['awards']=Award::with(['learner' => function($query){
                 $query->whereIn('id',Auth::user()->account->learners()->pluck('learners.id')->toArray());
            }])->whereIn('learner_id',Auth::user()->account->learners()->pluck('learners.id')->toArray())->orderBy('created_at', 'desc')->get();

            return view('awards.index', $data);
        }
        else{
            $data['awards']=Award::where('learner_id',Auth::user()->account_id)->orderBy('created_at', 'desc')->get();
            return view('awards.awards', $data);
        }

    }
    public function store(Request $request)
    {
        DB::beginTransaction();

        $data = $request->all();
        $data['learner_id'] = Auth::user()->account_id;
        Award::create($data);

    }
}
