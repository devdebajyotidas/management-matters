<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
//    $o = \App\Models\Organization::with(['departments.learners'])->find(6);

    $l = \App\Models\Learner::with(['department.organization'])->find(1);
//    dd($l->organization);
//    return view('test',['org'=>$o]);
    return view('test',['org'=>$l]);
});

Route::group(['namespace' => 'Web'], function () {

    Auth::routes();
    Route::get('logout', 'Auth\LoginController@logout');

    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/restricted', 'HomeController@restricted')->name('restricted');
    Route::get('/unauthorized', 'Auth\LoginController@unauthorized')->name('unauthorized');

//    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('cost', 'HomeController@cost');

    Route::get('dashboard', 'DashboardController@index');

    Route::get('learners', 'LearnerController@index');
    Route::get('learners/{id}', 'LearnerController@show');
    Route::get('learners/{id}/quiz', 'LearnerController@quiz');
    Route::post('learners', 'LearnerController@store');
    Route::put('learners/{id}', 'LearnerController@update');
    Route::delete('learners/{id}', 'LearnerController@delete');
    Route::put('learners/{id}/restore', 'LearnerController@restore');


    Route::get('organizations/{orgId}/learners', 'OrganizationLearnerController@index');
    Route::post('organizations/{orgId}/learners', 'OrganizationLearnerController@store');
    Route::get('organizations/{orgId}/learners/{id}', 'OrganizationLearnerController@show');
    Route::put('organizations/{orgId}/learners/{id}', 'OrganizationLearnerController@update');
    Route::delete('organization/{orgId}/learners/{id}', 'OrganizationLearnerController@delete');
    Route::put('organization/{orgId}/learners/{id}/restore', 'OrganizationLearnerController@restore');

    Route::post('organization/{orgId}/departments/', 'DepartmentController@store');
    Route::put('organization/{orgId}/departments/{id}', 'DepartmentController@update');

    Route::get('learnings', 'LearningController@index');
    Route::get('learnings/create', 'LearningController@create');
    Route::post('learnings/create', 'LearningController@store');
    Route::get('learnings/{id}', 'LearningController@show');
    Route::get('learnings/{id}/edit', 'LearningController@edit');
    Route::put('learnings/{id}/edit', 'LearningController@update');

    Route::get('assessments', 'AssessmentController@index');
    Route::get('assessments/new', 'AssessmentController@create');
    Route::post('assessments/new', 'AssessmentController@store');

    Route::get('tickets', 'TicketController@index');
    Route::post('tickets', 'TicketController@store');
    Route::put('tickets/{id}', 'TicketController@update');
    Route::delete('tickets/{id}', 'TicketController@delete');

    Route::resource('assignments','TicketAssignmentController');

    Route::get('awards', 'AwardController@index');
    Route::post('awards/create', 'AwardController@store');

    Route::get('organizations', 'OrganizationController@index');
    Route::get('organizations/{id}', 'OrganizationController@show');
    Route::post('organizations', 'OrganizationController@store');
    Route::put('organizations/{id}', 'OrganizationController@update');
    Route::delete('organizations/{id}', 'OrganizationController@delete');
    Route::put('organizations/{id}/restore', 'OrganizationController@restore');

    Route::get('learnings/{learningId}/quiz', 'QuizController@index');
    Route::get('learnings/{learningId}/quiz/{id}', 'QuizController@show');
    Route::post('learnings/{learningId}/quiz', 'QuizController@store');
    Route::put('learnings/{learningId}/quiz/{id}', 'QuizController@update');
    Route::get('quiz', 'QuizController@index');
//    });

//    Route::group(['prefix' => 'learner/{learnerId}', 'middleware' => 'auth'], function () {
//
//        Route::get('dashboard', 'DashboardController@learner');
//
//        Route::get('learnings', 'LearningController@index');
//        Route::get('learnings/{id}', 'LearningController@show');
//
//        Route::get('assessments', 'AssessmentController@index');
//        Route::get('tickets', 'TicketController@index');
//        Route::post('tickets', 'TicketController@store');
//        Route::put('tickets/{id}', 'TicketController@update');
//        Route::get('awards', 'AwardController@index');
//
//    });
//
//    Route::group(['prefix' => 'organization/{orgId}', 'middleware' => 'auth'], function () {
//
//        Route::get('dashboard', 'DashboardController@organization');
//
////        Route::get('/{orgId}/learners', 'OrganizationLearnerController@index');
//        Route::get('learners', 'OrganizationLearnerController@index');
//        Route::post('learners', 'OrganizationLearnerController@store');
//        Route::put('learners/{id}', 'OrganizationLearnerController@update');
//        Route::delete('learners/{id}', 'OrganizationLearnerController@delete');
//
////        Route::get('/{orgId}/learners/{id}', 'LearnerController@show');
//        Route::get('learners/{id}', 'LearnerController@show');
//
//        Route::post('departments/', 'DepartmentController@store');
//        Route::put('departments/{id}', 'DepartmentController@update');
//
//        Route::get('learnings', 'LearningController@index');
//        Route::get('learnings/{id}', 'LearningController@show');
//
//        Route::get('assessments', 'AssessmentController@index');
//        Route::get('tickets', 'OrganizationTicketController@index');
//        Route::get('awards', 'OrganizationAwardController@index');
//
//    });

//    Route::group(['prefix' => 'organization'], function () {
//
//        Route::get('dashboard', 'DashboardController@organization');
//
//        Route::get('/{orgId}/learners', 'OrganizationLearnerController@index');
//        Route::get('learners', 'OrganizationLearnerController@index');
//        Route::post('learners', 'OrganizationLearnerController@store');
//        Route::put('learners/{id}', 'OrganizationLearnerController@update');
//        Route::delete('learners/{id}', 'OrganizationLearnerController@delete');
//
////        Route::get('/{orgId}/learners/{id}', 'LearnerController@show');
//        Route::get('learners/{id}', 'LearnerController@show');
//
//        Route::post('departments/', 'DepartmentController@store');
//        Route::put('departments/{id}', 'DepartmentController@update');
//
//        Route::get('learnings', 'LearningController@index');
//        Route::get('learnings/{id}', 'LearningController@show');
//
//        Route::get('assessments', 'AssessmentController@index');
//        Route::get('tickets', 'TicketController@index');
//        Route::get('awards', 'AwardController@index');
//
//    });


//    Route::get('learnings','LearnerController@learnings');
//    Route::get('assessment','LearnerController@assessment');
//    Route::get('tickets','LearnerController@tickets');
//    Route::get('awards','LearnerController@awards');
//
//    Route::get('dashboard','HomeController@dashboard');


});
