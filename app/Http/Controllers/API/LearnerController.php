<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Eloquent\Learner;
use App\Repositories\Eloquent\User;

class LearnerController extends Controller
{
    private $learner;
    private $user;

    public function __construct(Learner $learner, User $user)
    {
        $this->learner = $learner;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return response()->json($this->learner->all(), Response::HTTP_OK);
    }


    public function create()
    {
    }

    /**
     * Create a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        DB::beginTransaction();

        $data['learner'] = $request->get('learner');
        $data['user'] = $request->get('user');

        // Validate the request
        $learnerValidator = Validator::make($data['learner'], $this->learner->rules('create'));
        $userValidator = Validator::make($data['user'], User::rules('create'));

        // Check if validation passes
        if ($learnerValidator->passes() && $userValidator->passes()) {

            // Creating a new User
            $user = User::create($data['user']);
            $user->attachRole('learner');

            // Creating a new Learner
            $learner = $this->learner->create($data);
            $learner->user()->save($user);

            DB::commit();

            // Return Learner object
            return response()->json($learner, Response::HTTP_CREATED);

        } else {
            DB::rollBack();
            $errors = json_encode(array_merge(json_decode($learnerValidator->errors(), true), json_decode($userValidator->errors(), true)));
            throw new \InvalidArgumentException($errors);
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
        DB::beginTransaction();

        $data['learner'] = $request->get('learner');
        $data['user'] = $request->get('user');

        unset($data['user']['username']);

        // Validate the request
        $learnerValidator = Validator::make($data['learner'], $this->learner->rules('update'));
        $userValidator = Validator::make($data['user'], User::rules('update'));

        if ($learnerValidator->passes() && $userValidator->passes()) {
            $learner = $this->learner->update($data['learner'], $id);
            $user = User::update($data['user'], $this->learner->find($id,['id'])->user->id);
            DB::commit();
            return response()->json(($learner AND $user), Response::HTTP_OK);
        } else {
            DB::rollBack();
            $errors = json_encode(array_merge(json_decode($learnerValidator->errors(), true), json_decode($userValidator->errors(), true)));
            throw new \InvalidArgumentException($errors);
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
        return response()->json($this->learner->delete($id));
    }
}
