<?php

use Illuminate\Http\Request;

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
    Route::get('learnings/{id}', 'LearningController@show');
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
        return \App\Models\Ticket::with(['assignments', 'learning'])->where('learner_id', '=', $id)->get();
    });

    Route::post('learners/{learnerId}/tickets', 'TicketController@store');
    Route::post('learners/{learnerId}/tickets/{id}', 'TicketController@update');
    Route::post('learners/{learnerId}/tickets/{id}', 'TicketController@delete');

    Route::get('learners/{id}/awards', function (Request $request, $id){
        return \App\Models\Award::where('learner_id', '=', $id)->get();
    });

});