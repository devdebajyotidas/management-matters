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
        $assessments = Assessment::where(['learner_id' => $id])->orderBy('id', 'DESC')->get();

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
            if(is_array($learning->assessments))
            {
                foreach($learning->assessments as $key => $assessment)
                {
                    $assessments[$num]['assessments'][$i] = $assessment;
                    $i++;
                }
            }
            shuffle($assessments[$num]['assessments']);
            $assessments[$num]['assessments'] = array_slice($assessments[$num]['assessments'], 0, 3, true);
        }

        return response()->json($assessments);
    }

    public function store(Request $request, $learnerId)
    {
        DB::beginTransaction();

        $assessments = [];
        $data = $request->all();

        $totalAvg = 0;
        $scores = [];
        foreach ($data['assessments'] as $result) {
            $learning = $result['model'];
            $answers = $result['answer'];
            $score = 0;
            foreach ($answers as $answer) {
                $score += intval($answer);
            }
            $totalAvg += $avg = $score / count($answers);
            $scores[$learning] = (float)number_format((float)$avg, 2, '.', '');
        }

        arsort($scores);
        $totalAvg = $totalAvg / count($data['assessments']);
        $scores['Average'] = (float)number_format((float)($totalAvg), 2, '.', '');


        $assessments = [
            'learner_id' => $learnerId,
            'scores' => $scores
        ];

        $new = Assessment::create($assessments);

        if ($new){

            DB::commit();
            return response()->json($new);
        }

        else{

            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }



    }
}
