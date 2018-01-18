<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Learner;
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

            $customerValidator = Validator::make($data['learner'], Learner::$rules['create']);
            $userValidator = Validator::make($data['user'], User::$rules['create']);

            if ($customerValidator->passes() && $userValidator->passes())
            {
                $customer = Learner::create($data['learner']);
                $user = User::create($data['user']);
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
}
