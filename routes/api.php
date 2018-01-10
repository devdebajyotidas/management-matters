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


Route::group(['namespace' => 'API', 'middleware' => 'auth:api'], function () {

    Route::post('learners', 'LearnerController@create');
    Route::put('learners/{id}', 'LearnerController@update');
    Route::get('learners', 'LearnerController@index');
    Route::get('learners/{id}', 'LearnerController@show');
    Route::delete('learners/{id}', 'LearnerController@destroy');

    // Not required
    Route::post('organizations', 'OrganizationController@create');
    Route::put('organizations/{id}', 'OrganizationController@update');
    Route::get('organizations', 'OrganizationController@index');
    Route::get('organizations/{id}', 'OrganizationController@show');
    Route::delete('organizations/{id}', 'OrganizationController@delete');

    // This may not required-- Route::post('learning', 'LearningController@create');
    // This may not reqiured--  Route::put('learning/{id}', 'LearningController@update');
    // Required
    Route::get('learning', 'LearningController@index');
    Route::get('learning/{id}', 'LearningController@show');
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

});