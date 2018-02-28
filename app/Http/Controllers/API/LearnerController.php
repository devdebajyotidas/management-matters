<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Award;
use App\Models\Learner;
use App\Models\Learning;
use App\Models\Quiz;
use App\Models\Subscription;
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
            $data['user']['verification_token']= $vtoken=md5(microtime());

            $subscription['subscription_id']='';
            $subscription['start_date']=date('Y-m-d H:i:s');
            $subscription['status']=1;

            $customerValidator = Validator::make($data['learner'], Learner::$rules['create']);
            $userValidator = Validator::make($data['user'], User::$rules['create']);

            if ($customerValidator->passes() && $userValidator->passes())
            {

                if($request->has('image') && $request->get('image') != null)
                {
                    $file = $request->get('image');
                    $image_base64 = base64_decode($file);
                    $name = public_path() . '/uploads/' . time() . rand(100,999) . ".jpg";
                    if(file_put_contents($name, $image_base64)){
                        $data['learner']['image'] = $name;
                    }else{
                        $data['learner']['image'] = null;
                    }
                }

                $customer = Learner::create($data['learner']);
                $user = User::make($data['user']);
                if($customer->user()->save($user)){
                    if(empty($customer->organization)){
                        $sub = Subscription::make($subscription);

                        $customer->subscription()->save($sub);
                        if(!empty($customer->name_on_card) && !empty($customer->card_number) && !empty($customer->expiry_date)){
                            $newreq= new \Illuminate\Http\Request();
                            $newreq->name_on_card=$customer->name_on_card;
                            $newreq->card_number=$customer->card_number;
                            $newreq->expiry_date=$customer->expiry_date;
                            app('App\Http\Controllers\Web\SubscriptionController')->subscribe($newreq,$customer->id);
                        }

                    }
                }
                $customer->load('user', 'department.organization');


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
        $response = [];
        try
        {
            $data['learner'] = $request->except('user');
            $data['user'] = $request->get('user');

            $customerValidator = Validator::make($data['learner'], Learner::$rules['update']);
            $userValidator = Validator::make($data['user'], User::$rules['update']);

            if ($customerValidator->passes() && $userValidator->passes())
            {
                $learner = Learner::find($id);
                $sub=Subscription::where('account_id',$id)->first();
                $learner->fill($data['learner']);
                $learner->save();
//                dd($learner);
//                $user = User::make($data['user']);
                $learner->user->fill($data['user']);
                $learner->user->save();
//                $user->fill($data['user'])
//                $learner->user()->save($user);
                $learner->load('user', 'department.organization');
                $newreq= new \Illuminate\Http\Request();
                if(isset($sub->subscription_id) && !empty($sub->subscription_id)){
                    $newreq->card_number=$data['learner']['card_number'];
                    $newreq->expiry_date=$data['learner']['expiry_date'];
                    app('App\Http\Controllers\Web\SubscriptionController')->update($newreq,$sub->subscription_id);

                }
                else{
                    if(!empty($data['learner']['card_number']) && !empty($data['learner']['expiry_date'])){
                        $newreq->name_on_card=$data['learner']['name_on_card'];
                        $newreq->card_number=$data['learner']['card_number'];
                        $newreq->expiry_date=$data['learner']['expiry_date'];
                        app('App\Http\Controllers\Web\SubscriptionController')->subscribe($newreq,$id);
                    }
                }
                $response['success'] = true;
                $response['account'] = $learner;
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
            $response['error'] = $exception->getTraceAsString();
            return $response;
        }
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

        $data['cost'] = Learner::find($id)->costs()->pluck('total', 'created_at');

        $cost = [];
        $i = 0;
        foreach ($data['cost'] as $key => $value)
        {
            $cost[$i]['key'] = $key;
            $cost[$i]['value'] = $value;

            $i++;
        }
        $data['cost'] = $cost;

        return $data;
    }
}
