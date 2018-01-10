<?php

namespace App\Http\Controllers\Web;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

use App\Models\Learner as Learner;
use App\Models\Organization as Organization;
use App\Models\User as User;

class OrganizationLearnerController extends Controller
{

    public function __construct(Organization $organization, Learner $learner, User $user,Subscription $subscription)
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        if (!$id)
            $id = Auth::user()->account_id;

        $organization = Organization::withTrashed()->with(['departments.learners.user','subscription'])->find($id);
        $data['page'] = 'learners';
        $data['role'] = session('role');
        $data['prefix'] = '/organization/' . $id;
        $data['organization'] = $organization;
        return view('organizations.learners', $data);
    }

    public function store(Request $request,$orgId)
    {
        DB::beginTransaction();

        $data['learner'] = $request->get('learner');
        $data['user'] = $request->get('user');

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

    public function update(Request $request,$orgId,$learnerId)
    {

    }

    public function delete(Request $request, $orgId, $learnerId)
    {
        $learner = Learner::withTrashed()->where('id', $learnerId)->first();

        if($learner->trashed())
        {
            if($learner->forceDelete()){
                return redirect()->back()->with(['success' => 'Learner removed successfully']);
            }
            else{
                return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
            }

        }
        else
        {
            if($learner->delete()){
                return redirect()->back()->with(['success' => 'Learner archived successfully']);
            }
            else{
                return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong!']);
            }

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
