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
    public function index($learningId = null)
    {
        $data['page'] = 'quiz';
        $data['role'] = session('role');
        $data['prefix']  = session('role');

        if(session('role')=='admin'){
            $data['organizations']=Organization::all(['id','name']);
            $data['quizs']=Quiz::with(['learner.department.organization','learning'])->orderBy('created_at','desc')->get();
            return view('quiz.index', $data);

        }
        else if(session('role')=='organization'){
            $data['departments'] = Department::where('organization_id',Auth::user()->account_id)->get();

            $learner_id=Auth::user()->account->learners()->pluck('learners.id')->toArray();
            $data['quizs']=Quiz::with(['learning', 'learner.department'])->whereIn('learner_id',$learner_id)->orderBy('created_at','desc')->get();
            return view('quiz.index', $data);
        }
        else{
            $data['learnings'] =  Learning::with(['quizTaken' => function($query){
                $query->where('learner_id','=',Auth::user()->account_id);
            }])->orderBy('created_at','desc')->get();
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
        $awstatus=null;
        $data = $request->all();
        $data['learner_id'] = Auth::user()->account_id;
        $data['learning_id'] = $learningId;
        $learning=Learning::find($learningId);
        $totalQues = count($learning->quiz);
        if($totalQues==intval($data['result'])){
            $data['is_completed'] = 1;
            $award['title']='Quiz completed for - '.$data['title'];
            $award['learner_id']=$data['learner_id'];
            $award['description']=$awstatus='quiz';
            Award::create($award);
        }
        else{
            $data['is_completed'] = 0;
        }

        if(!empty($awstatus)){
            $message="You've earned a management better badge! Keep up the good work!";
        }
        else{
            $message='Quiz result has been updated, keep up the good work to get a management matters badge!';
        }

        if(Quiz::create($data)){

            DB::commit();
            return redirect()->back()->with(['success'=>$message,'award'=>$awstatus]);
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

        $awstatus=null;
        $data['learner_id'] = Auth::user()->account_id;
        $data['learning_id'] = $learningId;
        $id=$data['taken_id'];
        $learning=Learning::find($learningId);
        $totalQues = count($learning->quiz);
        $quizTaken=Quiz::find($request->taken_id);
        if($totalQues==intval($data['result'])){
            if($quizTaken['is_completed']==0){
                $data['is_completed'] = 1;
                $award['title']='Quiz completed for - '.$data['title'];
                $award['learner_id']=$data['learner_id'];
                $award['description']=$awstatus='quiz';
                Award::create($award);
            }
            else{
                $data['is_completed'] = 1;
            }
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
            if(!empty($awstatus)){
                return redirect()->back()->with(['success'=>"You've earned a management better badge! Keep up the good work!",'award'=>$awstatus]);
            }
            else{
                return redirect()->back()->with(['success'=>'Quiz result has been updated','award'=>$awstatus]);
            }

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
