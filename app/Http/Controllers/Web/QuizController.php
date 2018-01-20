<?php

namespace App\Http\Controllers\web;

use App\Models\Award;
use App\Models\Department;
use App\Models\Learning;
use App\Models\Organization;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($learningId = null)
    {
        $data['page'] = 'quiz';
        $data['role'] = session('role');
        $data['prefix']  = session('role');

        if(session('role')=='admin'){
            $data['organizations']=Organization::all(['id','name']);
            $data['quizs']=Quiz::with(['learner','learning'])->get();
            return view('quiz.index', $data);

        }
        else if(session('role')=='organization'){
            $data['departments'] = Department::where('organization_id',Auth::user()->account_id)->get();

            $data['quizs']=Quiz::with(['learning', 'learner' => function($query){
                $query->whereIn('id', Auth::user()->account->learners()->pluck('learners.id')->toArray());
            }])->get();
            return view('quiz.index', $data);
        }
        else{
            $data['learnings'] =  Learning::with(['quizTaken' => function($query){
                $query->where('learner_id','=',Auth::user()->account_id);
            }])->get();
            $data['active_learning'] = $data['learnings']->find($learningId);
            return view('quiz.quiz', $data);
        }

    }

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
    public function store(Request $request, $learningId)
    {

        DB::beginTransaction();

        $data = $request->all();
        $data['learner_id'] = Auth::user()->account_id;
        $data['learning_id'] = $learningId;
        $learning=Learning::find($learningId);
        $totalQues = count($learning->quiz);
        if($totalQues==intval($data['result'])){
            $data['is_completed'] = 1;
            $award['title']='Quiz completed for - '.$data['title'];
            $award['learner_id']=$data['learner_id'];
            Award::create($award);
        }
        else{
            $data['is_completed'] = 0;
        }

        if(Quiz::create($data)){

            DB::commit();
            return redirect()->back()->with('success', 'Quiz has been submitted');
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
    public function show($learningId, $id)
    {
        $data['page'] = 'learnings';
        $data['role'] = session('role');
        $data['prefix']  = session('role');

        $data['learnings'] =  Learning::with(['quizTaken' => function($query){
            $query->where('learner_id','=',Auth::user()->account_id)->first();
        }])->get();

        $data['active_learning'] = $data['learnings']->find($learningId);

        return view('quiz.quiz', $data);
    }

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
    public function update(Request $request, $learningId)
    {
        DB::beginTransaction();

        $data = $request->all();

        $data['learner_id'] = Auth::user()->account_id;
        $data['learning_id'] = $learningId;
        $id=$data['taken_id'];
        $learning=Learning::find($learningId);
        $totalQues = count($learning->quiz);
        if($totalQues==intval($data['result'])){
            $data['is_completed'] = 1;
            $award['title']='Quiz completed for - '.$data['title'];
            $award['learner_id']=$data['learner_id'];
            Award::create($award);
        }
        else{
            $data['is_completed'] = 0;
        }
        $q = Quiz::find($id);
        $q->result=$data['result'];
        $q->is_completed = $data['is_completed'];
        $q->save();


        if( $q->save()){

            DB::commit();
            return redirect()->back()->with('success', 'Quiz result has been updated');
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
