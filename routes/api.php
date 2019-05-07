<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'API'], function () {

    Route::post('assessments/shares/check','AssessmentController@checkInvitation');
    Route::post('assessments/shares/submit','AssessmentController@submitAssessment');
    Route::post('assessments/shares/email','AssessmentController@emailAssessment');

    Route::post('learners', 'LearnerController@create');
    Route::put('learners/{id}', 'LearnerController@update');
    Route::get('learners', 'LearnerController@index');
    Route::get('learners/{id}', 'LearnerController@show');
    Route::delete('learners/{id}', 'LearnerController@destroy');
    Route::post('learners/login', 'UserController@login');
    Route::post('learners', 'LearnerController@store');
    Route::get('learners/{id}/dashboard', 'LearnerController@dashboard');

    // Not required
    Route::post('organizations', 'OrganizationController@create');
    Route::put('organizations/{id}', 'OrganizationController@update');
    Route::get('organizations', 'OrganizationController@index');
    Route::get('organizations/{id}', 'OrganizationController@show');
    Route::delete('organizations/{id}', 'OrganizationController@delete');

    // This may not required-- Route::post('learning', 'LearningController@create');
    // This may not reqiured--  Route::put('learning/{id}', 'LearningController@update');
    // Required
    Route::get('learnings', 'LearningController@index');
    Route::get('learnings/{id}', 'LearningController@getLearning');
    // This may not required-- Route::delete('learning/{id}', 'LrganizationController@delete');


    // Need Assessments statements for a learner
    Route::get('learning', 'LearningController@index');
    // Post Assessment Submission
    Route::post('learning', 'LearningController@index');
    // Need Assessment Restults for a learner
    Route::get('learning', 'LearningController@index');


    // Need Quiz Contents
    Route::get('learning', 'LearningController@index');
    // Post Quiz Submission
    Route::post('learning', 'LearningController@index');
    // Need Quiz Results or a learner
    Route::get('learning', 'LearningController@index');


    // Need Learner Login
    // Need Password Reset


    Route::get('learners/{id}/tickets', function (Request $request, $id){
        return \App\Models\Ticket::with(['assignments', 'learning' => function($query){
            $query->select('id','title');
        }])->where('learner_id', '=', $id)->get();
    });

    Route::post('learners/{learnerId}/tickets', 'TicketController@store');
    Route::post('learners/{learnerId}/tickets/{id}', 'TicketController@update');
    Route::post('learners/{learnerId}/tickets/{id}', 'TicketController@delete');

    Route::get('learners/{id}/awards', function (Request $request, $id){
        return \App\Models\Award::where('learner_id', '=', $id)->get();
    });

    Route::get('learners/{learnerId}/quiz', 'QuizController@index');

    Route::get('learnings/{learningId}/quiz', 'QuizController@index');
    Route::get('learnings/{learningId}/quiz/{id}', 'QuizController@show');
    Route::post('learnings/{learningId}/quiz', 'QuizController@store');
    Route::put('learnings/{learningId}/quiz', 'QuizController@update');
    Route::get('quiz', 'QuizController@index');

    Route::get('tickets', 'TicketController@index');
    Route::get('tickets/events', 'TicketController@events');
    Route::post('tickets', 'TicketController@store');
    Route::put('tickets/{id}', 'TicketController@update');
    Route::delete('tickets/{id}', 'TicketController@delete');

    Route::post('assignments','TicketAssignmentController@store');
    Route::put('assignments/{id}','TicketAssignmentController@update');
    Route::delete('assignments/{id}','TicketAssignmentController@delete');

    Route::get('learners/{learnerId}/assessments','AssessmentController@index');
    Route::get('learners/{learnerId}/assessments/new','AssessmentController@create');
    Route::post('learners/{learnerId}/assessments','AssessmentController@store');

    Route::post('subscription/{id}/subscribe', 'SubscriptionController@subscribe');//learner id
    Route::delete('subscription/{id}/cancel', 'SubscriptionController@cancel');//subscription id
    Route::post('subscription/{id}/update', 'SubscriptionController@update');//subscription id

    Route::get('cost', function (){
        $content = Storage::disk('public')->get('CostOfNot/content.txt');
        return response()->json(['content' => $content]);
    });

    Route::post('cost', function (Request $request){

        $data['cost']=$request->all();
        $result = \App\Models\CostOfNot::create($data['cost']);

        $response = [];

        if($result)
        {
            $response['success'] = true;
            $response['cost'] = $result;
            return response()->json($response);
        }
        else
        {
            $response['success'] = false;
            $response['cost'] = null;
            return response()->json($response);
        }
    });

    Route::get('learners/{learnerId}/cost', 'CostController@index');
    Route::post('learners/{learnerId}/cost', 'CostController@store');

});