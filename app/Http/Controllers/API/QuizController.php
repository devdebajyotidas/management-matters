<?php

namespace App\Http\Controllers\API;

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

    public function index($learningId = null)
    {
        $data['learnings'] =  Learning::with(['quizTaken' => function($query){
            $query->where('learner_id','=',Auth::user()->account_id);
        }])->get();
        $data['active_learning'] = $data['learnings']->find($learningId);
        return view('quiz.quiz', $data);
    }

    public function store(Request $request, $learningId)
    {

        DB::beginTransaction();

        $data = $request->all();
//        $data['learner_id'] = $data[''];
//        $data['learning_id'] = $learningId;
        $learning=Learning::find($learningId);
        $totalQues = count($learning->quiz);

        if($totalQues==intval($data['result']))
        {
            $data['is_completed'] = 1;
            $award['title']='Quiz completed for - '.$data['title'];
            $award['learner_id']=$data['learner_id'];
            $award = Award::create($award);
        }
        else
        {
            $award = false;
            $data['is_completed'] = 0;
        }

        $quiz = Quiz::create($data);

        if($quiz)
        {
            DB::commit();
            return response()->json([
                'quiz' => $quiz,
                'award' => $award,
                'error' => ''
            ]);
        }
        else
        {
            DB::rollBack();
            return response()->json([
                'quiz' => null,
                'award' => null,
                'error' => 'Something went wrong!'
            ]);
        }
    }

    public function update(Request $request, $learningId)
    {
        DB::beginTransaction();

        $data = $request->all();

//        $data['learner_id'] = Auth::user()->account_id;
//        $data['learning_id'] = $learningId;
        $id=$data['taken_id'];
        $learning=Learning::find($learningId);
        $totalQues = count($learning->quiz);
        if($totalQues==intval($data['result'])){
            $data['is_completed'] = 1;
            $award['title']='Quiz completed for - '.$data['title'];
            $award['learner_id']=$data['learner_id'];
            $award = Award::create($award);
        }
        else
        {
            $award = false;
            $data['is_completed'] = 0;
        }
        $quiz = Quiz::find($id);
        $quiz->result=$data['result'];
        $quiz->is_completed = $data['is_completed'];
//        $q->save();

        if($quiz->save())
        {
            DB::commit();
            return response()->json([
                'quiz' => $quiz,
                'award' => $award,
                'error' => ''
            ]);
        }
        else
        {
            DB::rollBack();
            return response()->json([
                'quiz' => null,
                'award' => null,
                'error' => 'Something went wrong!'
            ]);
        }
    }
}
