<?php

namespace App\Http\Controllers\Web;

use App\Jobs\StoreAssessmentSet;
use App\Models\AssessmentSet;
use App\Models\AssessmentStatement;
use App\Models\Award;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Assessment;
use App\Models\Learner;
use App\Models\Learning;
use App\Models\Organization;
use App\Models\Department;
use Illuminate\Support\Facades\Log;

class AssessmentController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $CSS_COLOR_NAMES = ["AliceBlue", "AntiqueWhite", "Aqua", "Aquamarine", "Azure", "Beige", "Bisque", "Black", "BlanchedAlmond", "Blue", "BlueViolet", "Brown", "BurlyWood", "CadetBlue", "Chartreuse", "Chocolate", "Coral", "CornflowerBlue", "Cornsilk", "Crimson", "Cyan", "DarkBlue", "DarkCyan", "DarkGoldenRod", "DarkGray", "DarkGrey", "DarkGreen", "DarkKhaki", "DarkMagenta", "DarkOliveGreen", "Darkorange", "DarkOrchid", "DarkRed", "DarkSalmon", "DarkSeaGreen", "DarkSlateBlue", "DarkSlateGray", "DarkSlateGrey", "DarkTurquoise", "DarkViolet", "DeepPink", "DeepSkyBlue", "DimGray", "DimGrey", "DodgerBlue", "FireBrick", "FloralWhite", "ForestGreen", "Fuchsia", "Gainsboro", "GhostWhite", "Gold", "GoldenRod", "Gray", "Grey", "Green", "GreenYellow", "HoneyDew", "HotPink", "IndianRed", "Indigo", "Ivory", "Khaki", "Lavender", "LavenderBlush", "LawnGreen", "LemonChiffon", "LightBlue", "LightCoral", "LightCyan", "LightGoldenRodYellow", "LightGray", "LightGrey", "LightGreen", "LightPink", "LightSalmon", "LightSeaGreen", "LightSkyBlue", "LightSlateGray", "LightSlateGrey", "LightSteelBlue", "LightYellow", "Lime", "LimeGreen", "Linen", "Magenta", "Maroon", "MediumAquaMarine", "MediumBlue", "MediumOrchid", "MediumPurple", "MediumSeaGreen", "MediumSlateBlue", "MediumSpringGreen", "MediumTurquoise", "MediumVioletRed", "MidnightBlue", "MintCream", "MistyRose", "Moccasin", "NavajoWhite", "Navy", "OldLace", "Olive", "OliveDrab", "Orange", "OrangeRed", "Orchid", "PaleGoldenRod", "PaleGreen", "PaleTurquoise", "PaleVioletRed", "PapayaWhip", "PeachPuff", "Peru", "Pink", "Plum", "PowderBlue", "Purple", "Red", "RosyBrown", "RoyalBlue", "SaddleBrown", "Salmon", "SandyBrown", "SeaGreen", "SeaShell", "Sienna", "Silver", "SkyBlue", "SlateBlue", "SlateGray", "SlateGrey", "Snow", "SpringGreen", "SteelBlue", "Tan", "Teal", "Thistle", "Tomato", "Turquoise", "Violet", "Wheat", "White", "WhiteSmoke", "Yellow", "YellowGreen"];
        $learnings = Learning::all(['id', 'title']);

        $data['page'] = 'assessments';
        $data['role'] = session('role');
        $data['learnings'] = $learnings;
        $data['CSS_COLOR_NAMES'] = array_slice($CSS_COLOR_NAMES, 10, $data['learnings']->count());

        if(session('role') == 'learner'){
            $assessments = Assessment::where(['learner_id' => Auth::user()->account_id])->orderBy('created_at','desc')->get();
        }
        elseif(session('role') == 'admin'){
            $data['organizations']=Organization::all(['id','name']);
            $assessments = Assessment::with(['learner.department.organization'])->orderBy('created_at','desc')->get();
        }
        else {
            $data['departments'] = Department::where('organization_id', Auth::user()->account_id)->get();
            $learners = Auth::user()->account->learners()->select('learners.id')->pluck('id');
            $assessments = Assessment::with('learner.department')->whereIn('learner_id', $learners)->orderBy('created_at','desc')->get();
        }

        $data['assessments'] = $assessments;
        $new_assessments=$assessments->reverse();
        $data['dates'] = $new_assessments->pluck('created_at');

        $scores = [];

        foreach ($new_assessments as $key => $assessment) {
            $key = 0;
            foreach ($assessment->scores as $learning => $score) {
                if (isset($scores[$key]['name'])) {
                    $scores[$key]['data'] = array_merge($scores[$key]['data'], [$score]);
                } else {
                    $scores[$key]['name'] = $learning;
                    $scores[$key]['data'] = [$score];
                }
                $key++;
            }
        }

        $data['scores'] = $scores;
        return view('assessments.index', $data);
    }

    public function create()
    {
        $data['learnings'] = Learning::all(['title', 'assessments']);
        $data['page'] = 'assessments';
        $data['role'] = session('role');
        $data['prefix'] = session('role');

        return view('assessments.new', $data);
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
            $totalAvg += $avg = $score / count($answers);
            $scores[$learning] = (float)number_format((float)$avg, 2, '.', '');
        }

        arsort($scores);
        $totalAvg = $totalAvg / count($data['assessments']);
        $scores['Average'] = (float)number_format((float)($totalAvg), 2, '.', '');


        $assessments = [
            'learner_id' => Auth::user()->account_id,
            'scores' => $scores
        ];

        if (Assessment::create($assessments)){

            $data['awards']['learner_id']=Auth::user()->account_id;
            $data['awards']['title']='Completed an assessment';
            $data['awards']['description']='assessment';
            Award::create($data['awards']);

            DB::commit();
            return redirect()->intended('assessments')->with('success', "Assessment Completion! Use to Manage Better!");
        }

        else{

            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }

    }

    public function getAssessments(){

        $learnings = Learning::all(['title', 'assessments']);
        $assessments = [];

        $i = 0;
        foreach($learnings as $num => $learning)
        {
            $title = $learning->title;
            if(is_array($learning->assessments))
            {
                $statements = collect($learning->assessments)->shuffle();
                foreach($statements as $key => $assessment)
                {
                    if($key < 3){
                        $assessmentStatements['name'] = $title;
                        $assessmentStatements['statement'] = $assessment;
                        array_push($assessments, $assessmentStatements);
                        $i++;
                    }

                }
            }
        }

        shuffle($assessments);
        shuffle($assessments);

        $set['assessments'] = $assessments;
        $set['assessor_id'] = auth()->user()->id;
        $set['organization_id'] = Auth::user()->account_id;


        $reference = $this->storeAssessment($set);

        $data['assessmentSet'] = AssessmentSet::where('reference', $reference)->where('assessor_id', $set['assessor_id'])->with(['statements' => function($q){
            $q->where('type', 1);
        }, 'assessor.account'])->first();

        $data['page'] = 'assessments';
        $data['role'] = session('role');
        $data['prefix'] = session('role');

        return view('assessments.new', $data);
    }

    public function storeAssessment($data){
        $assessments = $data['assessments'];
        $assessor_id = $data['assessor_id'];
        $organization_id = $data['organization_id'];

        $successCount = 0;

        if(count($assessments) > 0){

            $set['assessor_id'] = $assessor_id;
            $set['organization_id'] = $organization_id;
            $set['reference'] = md5(time());
            $assessmentSet = AssessmentSet::create($set);
            $setId =$assessmentSet->id;

            foreach ($assessments as  $assessment){
                $module = $assessment['name'];

                if($assessment['statement']){
                    $statement = $assessment['statement'];
                    $data['assessor_statement'] = $statement;
                    $data['assessment_id'] = $setId;
                    $data['type'] = 1;
                    $data['module'] = $module;
                    $data['assessee_statement'] = str_replace('am', '', str_replace('I', 'My Manager', $statement));

                    if(AssessmentStatement::create($data)){
                        $successCount++;
                    }
                }
            }

            if($successCount > 0){
                return $set['reference'];
            }
        }

        return null;
    }

    public function getSharedAssessment(Request $request, $assessor_id){
        $data['page'] = 'assessments';
        $reference = $request->get('ref');
        $data['error'] = '';

        if(!$reference && !$assessor_id){
            $data['error'] = 'Sorry, you are not authorized to take this assessment';
        }

        $assessmentSet = AssessmentSet::where('reference', $reference)->where('assessor_id', $assessor_id)->with(['statements', 'assessor.account'])->first();
        if(!$assessmentSet){
            $data['error'] = 'No assessment to be taken';
        }
        else{
            $data['learning'] = $assessmentSet;
        }

        return view('assessments.shares.index', $data);

    }
}
