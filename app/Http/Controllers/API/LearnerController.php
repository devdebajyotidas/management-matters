<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Award;
use App\Models\Learner;
use App\Models\Learning;
use App\Models\Quiz;
use App\Models\Ticket;
use App\Models\TicketAssignment;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LearnerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Learner::all();
    }


    public function create()
    {
    }

    public function store(Request $request)
    {
        $response = [];
        try
        {
            $data['learner'] = $request->except('user');
            $data['user'] = $request->get('user');
            $data['user']['password_confirmation'] =  $data['user']['password'];

            $customerValidator = Validator::make($data['learner'], Learner::$rules['create']);
            $userValidator = Validator::make($data['user'], User::$rules['create']);

            if ($customerValidator->passes() && $userValidator->passes())
            {
                $customer = Learner::create($data['learner']);
                $user = User::make($data['user']);
                $customer->user()->save($user);
                $customer->load('user');

                $response['success'] = true;
                $response['account'] = $customer;
                $response['error'] = '';
            }
            else
            {
                $errors = implode(',',call_user_func_array('array_merge', array_values(json_decode($customerValidator->errors()->merge($userValidator->errors()),true))));
                $response['success'] = false;
                $response['account'] = null;
                $response['error'] = $errors;
            }

            return $response;

        }catch (\Exception $exception)
        {
            $response['success'] = false;
            $response['account'] = null;
            $response['error'] = $exception->getMessage();
            return $response;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->learner->find($id), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

    }

    public function dashboard($id)
    {
        $learnings = Learning::count();
        $outstandingTickets = Ticket::where('is_completed', '=', 0);
        $completedTickets = Ticket::where('is_completed', '=', 1);
        $archivedTickets = Ticket::where('is_archived', '=', 1);
        $totalTickets = Ticket::where('learner_id', '=', $id);
        $ticketAssignments = TicketAssignment::where('id', '>', 0);
        $awards = Award::where('id', '>', 0);
        $assessments = Assessment::where('id', '>', 0);
        $quiz = Quiz::where('id', '>', 0);


        $data['learnings'] = $learnings;
        $data['outstandingTickets'] = $outstandingTickets->where('learner_id', '=', $id)->count();
        $data['completedTickets'] = $completedTickets->where('learner_id', '=', $id)->count();
        $data['archivedTickets'] = $archivedTickets->where('learner_id', '=', $id)->count();
        $data['totalTickets'] = $totalTickets->count();
        $data['ticketAssignments'] = $ticketAssignments->with(['ticket' => function($query) use($id){
            $query->where('learner_id', '=', $id);
        }])->count();
        $data['awards'] = $awards->where('learner_id', '=', $id)->count();
        $data['assessments'] = $assessments->where('learner_id', '=', $id)->count();
        $data['quiz'] = $quiz->where('learner_id', '=', $id)->count();

        return $data;
    }
}
