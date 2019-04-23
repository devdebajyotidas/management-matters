<?php

namespace App\Http\Controllers\API;


use App\Models\AssessmentInvitation;
use App\Models\AssessmentResult;
use App\Models\AssessmentSet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Assessment;
use App\Models\Learner;
use App\Models\Learning;
use Illuminate\Support\Facades\Mail;

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

    function checkInvitation(Request $request){
        $response['success'] = true;

        $email = $request->get('email');
        if(!$email){
            $response['success'] = false;
            $response['message'] = "Email is required";
        }

        $exists = AssessmentResult::where('email', $email)->exists();
        if($exists){
            $response['success'] = true;
            $response['message'] = "You've alrady taken this assessment";
        }

        $assessmentSet = AssessmentSet::where('reference', $request->get('ref'))->where('assessor_id', $request->get('assessor'))->with(['statements', 'assessor.account'])->first();

        $response['data'] = $assessmentSet;

        return response()->json($response);
    }

    function submitAssessment(Request $request){
        $name =  $request->get('name');
        $email =  $request->get('email');
        $assessmentId = $request->get('assessment');

        $totalCount = 0;
        $totalSum = 0;

        $resultArr = [];

        $data = $request->all();
        if(count($data) > 0){
            foreach ($data['assessments'] as $key => $module){
                $moduleTotal = 0;
                foreach ($module as $score){
                    $totalCount ++;
                    $totalSum += $score;
                    $moduleTotal += $score;
                }

                $resultArr[$key] = number_format(($moduleTotal / count($module)), 2);
            }
        }

        $totalAvg = ($totalSum/ ($totalCount ? $totalCount : 1));

        $data['email'] = $email;
        $data['name'] = $name;
        $data['total_average'] = number_format($totalAvg, 2);
        $resultArr['Average'] = $data['total_average'];
        $data['result'] = json_encode($resultArr);
        $data['is_self'] = $request->get('self') ? $request->get('self') : 0;
        $data['assessment_id'] = $assessmentId;

        $result = AssessmentResult::create($data);

        if($result){
           $response['success'] = true;
           $response['message'] = 'Assessment has been submitted';
           $response['score'] = $data['total_average'];
        }
        else{
            $response['success'] = false;
            $response['message'] = "Something went wrong, Unable to submit the assessment";
            $response['score'] = 0;
        }

        $token = $this->updateTotalScore($assessmentId, $data['total_average']);
        $response['token'] = $token;
        return response()->json($response);

    }

    protected function updateTotalScore($assessmentId, $score){
        $assessmentSet = AssessmentSet::find($assessmentId);
        if($assessmentSet){
            $prevScore = $assessmentSet->score ? $assessmentSet->score : 0;
            $assessmentSet->score = ($prevScore + $score);
            $assessmentSet->save();

            return $assessmentSet->reference;
        }

        return null;
    }

    public function emailAssessment(Request $request){
//        Mail::send()
    }
}
