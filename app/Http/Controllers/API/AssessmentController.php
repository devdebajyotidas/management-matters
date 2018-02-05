<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Assessment;
use App\Models\Learner;
use App\Models\Learning;

class AssessmentController extends Controller
{
    public function index($id)
    {
        $assessments = Assessment::where(['learner_id' => $id])->get();

        $data['assessments'] = $assessments;

        foreach ($assessments as $key => $assessment)
        {
            $i = 0;
            $scores = [];
            foreach ($assessment->scores as $learning => $score)
            {
                $scores[$i]['name'] = $learning;
                $scores[$i]['score'] = $score;
                $i++;
            }
            $data['assessments'][$key]['scores'] = $scores;
        }

        $data['dates'] = $assessments->pluck('created_at');

        $scores = [];
        foreach ($assessments as $key => $assessment) {
            $key = 0;
            foreach ($assessment->scores as $learning => $score) {
                if (isset($scores[$key]['name'])) {
                    $scores[$key]['data'] = array_merge($scores[$key]['data'], [$score]);
                } else {
                    $scores[$key]['name'] = $learning;
                    $scores[$key]['data'] = [$score];
                    $scores[$key]['date'] = $assessment->created_at;
                }
                $key++;
            }
        }

        $data['scores'] = $scores;
        return response()->json($data);
    }

    public function create()
    {
        $learnings =  Learning::all(['title', 'assessments']);
        $assessments = [];

        $i = 0;
        foreach($learnings as $num => $learning)
        {
            $assessments[$num]['name'] = $learning->title;
            $assessments[$num]['assessments'] = [];
            foreach($learning->assessments as $key => $assessment)
            {
                $assessments[$num]['assessments'][$i] = $assessment;
                $i++;
            }
            shuffle($assessments[$num]['assessments']);
            $assessments[$num]['assessments'] = array_slice($assessments[$num]['assessments'], 0, 3, true);
        }

        return response()->json($assessments);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $assessments = [];
        $data = $request->all();

        $totalAvg = 0;
        $scores = [];
        foreach ($data['assessments'] as $learning => $answers) {
            $score = 0;
            foreach ($answers as $answer) {
                $score += intval($answer);
            }
            $totalAvg += $avg = $score / 3;
            $scores[$learning] = (float)number_format((float)$avg, 2, '.', '');
        }

        $totalAvg = $totalAvg / count($data['assessments']);
        $scores['Average'] = (float)number_format((float)($totalAvg), 2, '.', '');


        $assessments = [
            'learner_id' => Auth::user()->account_id,
            'scores' => $scores
        ];

        if (Assessment::create($assessments)){

            DB::commit();
            return redirect()->intended('assessments')->with('success', 'Assessment has been submitted');
        }

        else{

            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }



    }
}