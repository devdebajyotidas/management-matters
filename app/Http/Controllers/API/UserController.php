<?php

namespace App\Http\Controllers\API;

use App\Helper\ApiResponse;
use App\Http\Controllers\BaseController;
use App\Models\Learner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends BaseController
{

    public function login(Request $request)
    {
        try{
            if($request->get('password') && Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], true))
            {
                $user = Auth::user();

                if ($user->account instanceof Learner)
                {
                    $user->fcm_token = $request->get('fcm_token');
                    $user->save();

                    $user = $user->account->load('user', 'department.organization');

                    return $this->success($user, 'Successfully logged in');
                }
                else
                {
                    return $this->error('Invalid Email or Password!');
                }
            }
        }catch(Exception $e){
            return $this->error($e->getMessage());
        }
    }


    /**
     * Create a new user resource
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{
            // Validate the request
            $validator =  Validator::make($request->all(),User::$rules['create']);

            // Check if validation passes
            if($validator->passes()){

                // Creating a new User
                $user = User::create($request->all());

                // Return User object in response with status code 201
                $response = response()->json($user,Response::HTTP_CREATED);
            }else{
                // Return errors in response with status code 400
                $response = response()->json(['errors'=>$validator->errors()],Response::HTTP_BAD_REQUEST);
            }
            // Return the response
            return $response;

        }catch (\Exception $e){
            // Catch any exception that might occur on server and set response with status code 500
            return response()->json(['errors'=>$e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            // Check of the specific user, otherwise throw exception
            $user = User::findorFail($id);
            return response()->json($user,Response::HTTP_OK);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['errors' => 'Requested resource could not be found'],Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            // Check of the specific user, otherwise throw exception
            $user = User::findorFail($id);

            // Delete the user (Soft Delete)
            $user->delete();

            return response()->json($user->deleted_at,Response::HTTP_OK);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['errors' => 'Requested resource could not be found'],Response::HTTP_NOT_FOUND);
        }
    }
}
