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
            foreach($learning as $key => $assessment)
            {
                $assessments[$i]["assessment"] = $assessment;
                $assessments[$i]["assessment"] = $assessment;
                $i++;
            }
        }
     ( ($assessments = $learning->assessments) && shuffle($assessments))   ? '' : '';



//        return view('assessments.new', $data);
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
