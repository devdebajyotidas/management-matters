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

use App\Models\Learner;
use App\Models\Organization ;
use App\Models\User;
use App\Models\Assessment;
use App\Models\Quiz;
use App\Models\Ticket;
use App\Models\TicketAssignment;
use App\Models\Award;
use Illuminate\Support\Facades\Mail;

class OrganizationLearnerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checksub');

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

        $organization = Organization::withTrashed()->with(['departments.learners.user','subscription'])->orderBy('created_at','desc')->find($id);
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
        $data['user']['verification_token']= $vtoken=md5(microtime());

        if(!empty($data['learner']['department_id'])){
            $learnerValidator = Validator::make($data['learner'], Learner::$rules['create']);
            $userValidator = Validator::make($data['user'], User::$rules['create']);

            if ($learnerValidator->passes() && $userValidator->passes()) {

                $user = User::make($data['user']);
                $learner = Learner::create($data['learner']);

                $learner->user()->save($user);
                $user->attachRole('learner');

                $email['logo']=asset('assets/img/email-logo.png');
                $email['name']=$learner->name;
                $email['url']=url('verification').'?token='.$vtoken;

                $config=new \stdClass();
                $config->from=config('constants.EMAIL_FROM');
                $config->cc=config('constants.EMAIL_BCC');
                $config->bcc=config('constants.EMAIL_CC');

                Mail::send('emails.confirmation', $email, function($message) use($user,$config)
                {
                    $message->from($config->from,'Management Matters');
                    $message->cc($config->cc,'Samir Maikap');
                    $message->bcc($config->bcc,'Debajyoti Das');
                    $message->to($user->email);
                    $message->subject('Email verification required');

                });

                if(!empty(session('role'))){
                    $email['password']= $data['user']['password'];
                    $email['email']=$user->email;
                    $email['url']=url('login');
                    Mail::send('emails.welcome', $email, function($message) use($user,$config)
                    {
                        $message->from($config->from,'Management Matters');
                        $message->cc($config->cc,'Samir Maikap');
                        $message->bcc($config->bcc,'Debajyoti Das');
                        $message->to($user->email);
                        $message->subject('Welcome Aboard!');

                    });
                }

                DB::commit();

                return redirect()->back()->with('success', 'Learner added successfully');

            }
            else
            {
                DB::rollBack();
                $errors = $learnerValidator->errors()->merge($userValidator->errors());

                return redirect()->back()->withInput($request->all())->withErrors($errors,'learner');
            }
        }
        else{
            return redirect()->back()->withInput($request->all())->withErrors(['Please add a department'],'learner');
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
