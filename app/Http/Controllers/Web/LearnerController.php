<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

use App\Models\Learner;
use App\Models\User;
use App\Models\Department;
use App\Models\Organization;


class LearnerController extends Controller
{

    public function index()
    {
        $data['page'] = 'learners';
        $data['role'] = session('role');
        $data['departments'] = Department::all();
        $data['learners'] = Learner::withTrashed()->with(['department.organization','user'])->get();
        $data['organizations'] = Organization::all();
        $data['prefix']  = '';
        return view('learners.index', $data);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $data['learner'] = $request->get('learner');
        $data['user'] = $request->get('user');

        if(intval($request->get('learner')['organization']))
        {
            $newRequest = Request::create('organizations/'. intval($request->get('learner')['organization']) . '/learners', 'POST', $request->all());
            $response = Route::dispatch($newRequest);
            return redirect()->intended(url('learners'));
        }

        $learnerValidator = Validator::make($data['learner'], Learner::$rules['create']);
        $userValidator = Validator::make($data['user'], User::$rules['create']);

        if ($learnerValidator->passes() && $userValidator->passes()) {
            $user = User::make($request->get('user'));
            $learner = Learner::create($request->get('learner'));

            $learner->user()->save($user);
            $user->attachRole('learner');

            DB::commit();

            return redirect()->back()->with('success', 'Learner added successfully');
        }
        else
        {
            DB::rollBack();
            $errors = $learnerValidator->errors()->merge($userValidator->errors());

            return redirect()->back()->withInput($request->all())->withErrors($errors);
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
        $learner = Learner::find($id);
        $data['page'] = 'learners';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/' .Auth::user()->account_id;
        $data['learner'] = $learner;

        return view('learners.profile',$data);
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

        $learnerValidator = Validator::make($data['learner'], Learner::$rules['update']);
        if(trim($data['user']['password']) == '' || $data['user']['password'] == null){
            unset($data['user']['password']);
            unset($data['user']['password_confirmation']);
        }

        $userValidator = Validator::make($data['user'], User::$rules['update']);

        if ($learnerValidator->passes() && $userValidator->passes()) {

            if ($request->hasFile('learner.image')) {
                $file = $request->file('learner.image');
                $name = time().rand(100,999).".".$file->getClientOriginalExtension();
                if($file->move('uploads/',$name)){
                    $data['learner']['image'] = $name;
                }else{
                    $data['learner']['image'] = null;
                }
            }

            $learner = Learner::find($id);
            $learner->fill($data['learner']);

            $user = User::find($learner->user->id);
            $user->fill($data['user']);

            if($learner->save() && $user->save())
            {
                DB::commit();
                return redirect()->back()->with('success', 'Learner updated successfully');
            }
            else
            {
                DB::rollBack();
                return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
            }

        }
        else
        {
            DB::rollBack();
            $errors = $learnerValidator->errors()->merge($userValidator->errors());
            return redirect()->back()->withInput($request->all())->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
           $learner = Learner::withTrashed()->where('id', $id)->first();
           if($learner->trashed())
           {
               $learner->forceDelete();
               return redirect()->back()->with(['success' => 'Learner removed successfully']);
           }
           else
           {
               $learner->delete();
               return redirect()->back()->with(['success' => 'Learner archived successfully']);
           }
    }

    public function restore(Request $request, $id)
    {
        $learner = Learner::withTrashed()->where('id', $id)->first();
        if($learner->restore())
        {
            return redirect()->back()->with(['success' => 'Learner restored successfully']);
        }
        else
        {
            return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
        }

    }

}
