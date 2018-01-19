<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Assessment;
use App\Models\Learner;
use App\Models\Learning;

class AssessmentController extends Controller
{
    public function index()
    {
        $CSS_COLOR_NAMES = ["AliceBlue", "AntiqueWhite", "Aqua", "Aquamarine", "Azure", "Beige", "Bisque", "Black", "BlanchedAlmond", "Blue", "BlueViolet", "Brown", "BurlyWood", "CadetBlue", "Chartreuse", "Chocolate", "Coral", "CornflowerBlue", "Cornsilk", "Crimson", "Cyan", "DarkBlue", "DarkCyan", "DarkGoldenRod", "DarkGray", "DarkGrey", "DarkGreen", "DarkKhaki", "DarkMagenta", "DarkOliveGreen", "Darkorange", "DarkOrchid", "DarkRed", "DarkSalmon", "DarkSeaGreen", "DarkSlateBlue", "DarkSlateGray", "DarkSlateGrey", "DarkTurquoise", "DarkViolet", "DeepPink", "DeepSkyBlue", "DimGray", "DimGrey", "DodgerBlue", "FireBrick", "FloralWhite", "ForestGreen", "Fuchsia", "Gainsboro", "GhostWhite", "Gold", "GoldenRod", "Gray", "Grey", "Green", "GreenYellow", "HoneyDew", "HotPink", "IndianRed", "Indigo", "Ivory", "Khaki", "Lavender", "LavenderBlush", "LawnGreen", "LemonChiffon", "LightBlue", "LightCoral", "LightCyan", "LightGoldenRodYellow", "LightGray", "LightGrey", "LightGreen", "LightPink", "LightSalmon", "LightSeaGreen", "LightSkyBlue", "LightSlateGray", "LightSlateGrey", "LightSteelBlue", "LightYellow", "Lime", "LimeGreen", "Linen", "Magenta", "Maroon", "MediumAquaMarine", "MediumBlue", "MediumOrchid", "MediumPurple", "MediumSeaGreen", "MediumSlateBlue", "MediumSpringGreen", "MediumTurquoise", "MediumVioletRed", "MidnightBlue", "MintCream", "MistyRose", "Moccasin", "NavajoWhite", "Navy", "OldLace", "Olive", "OliveDrab", "Orange", "OrangeRed", "Orchid", "PaleGoldenRod", "PaleGreen", "PaleTurquoise", "PaleVioletRed", "PapayaWhip", "PeachPuff", "Peru", "Pink", "Plum", "PowderBlue", "Purple", "Red", "RosyBrown", "RoyalBlue", "SaddleBrown", "Salmon", "SandyBrown", "SeaGreen", "SeaShell", "Sienna", "Silver", "SkyBlue", "SlateBlue", "SlateGray", "SlateGrey", "Snow", "SpringGreen", "SteelBlue", "Tan", "Teal", "Thistle", "Tomato", "Turquoise", "Violet", "Wheat", "White", "WhiteSmoke", "Yellow", "YellowGreen"];
        $learnings = Learning::all(['id', 'title']);

        $data['page'] = 'assessments';
        $data['role'] = session('role');
        $data['learnings'] = $learnings;
        $data['CSS_COLOR_NAMES'] = array_slice($CSS_COLOR_NAMES, 10, $data['learnings']->count());

        if(session('role') == 'learner'){
            $assessments = Assessment::where(['learner_id' => Auth::user()->account_id])->get();
        }

        if(session('role') == 'admin'){
            $assessments = Assessment::all();
        };

        if(session('role') == 'organization'){
            $learners = Auth::user()->account->learners()->select('learners.id')->pluck('id');
            $assessments = Assessment::whereIn('learner_id', $learners)->get();
        }

        $data['assessments'] = $assessments;


        $scores = [];
        foreach ($assessments as $key => $assessment) {
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
                $score += floatval($answer/5);
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

    public function update(Request $request, $id)
    {

    }

    public function delete($id)
    {

    }
}
