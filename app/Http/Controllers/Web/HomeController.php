<?php

namespace App\Http\Controllers\Web;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthenticationCheck;
use App\Models\Assessment;
use App\Models\Award;
use App\Models\Department;
use App\Models\Organization;
use App\Models\Password;
use App\Models\Quiz;
use App\Models\Subscription;
use App\Models\Ticket;
use App\Models\TicketAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Learner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('home','resetpassword','sendpasslink','newpassword','setpassword','verifyemail','getintouch');
        $this->middleware('checksub')->only('cost');
    }
    
    public function home()
    {
        $user = Auth::user();
        if($user)
        {
            return redirect()->intended('dashboard');

        }else{
            return redirect()->intended('login')->withErrors(['Incorrect email or password']);
        }
    }

    public function message(){

        return view('errors.subscription');

    }

    public function abort(){
        return view('errors.verification');
    }

    public function cost()
    {
        return view('cost', ['page' => 'cost', 'role' => session('role')]);
    }

    public function restricted()
    {
        return view('errors.403');
    }

    public function profile(){
        $data['page'] = 'profile';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
         if(session('role')=='organization'){
             $data['organization']=Organization::with(['subscription'])->find(Auth::user()->account_id);
             return view('profile.organization', $data);
         }
         elseif(session('role')=='learner'){
             $data['learner']=Learner::with(['subscription'])->find(Auth::user()->account_id);
             return view('profile.learner', $data);
         }
    }

    public function cancelsub($subid){
        $response=app('App\Http\Controllers\Web\SubscriptionController')->cancel($subid);
        if($response){
            return redirect()->intended(url('logout'));
        }
        else{
            return redirect()->back()->withErrors(['Something went wrong']);
        }
    }

    public function removeaccount(){
        DB::beginTransaction();

        $tcount=0;
        $qcount=0;
        $amcount=0;
        $awardcount=0;


        if(session('role')=='learner'){
            $learner = Learner::withTrashed()->where('id', Auth::user()->account_id)->first();
            $subscription=Subscription::where('account_id',Auth::user()->account_id)->first();
            $user=User::where('account_id',Auth::user()->account_id)->first();
            $assessment=Assessment::where('learner_id',Auth::user()->account_id)->get();
            $award=Award::where('learner_id',Auth::user()->account_id)->get();
            $quiz=Quiz::where('learner_id',Auth::user()->account_id)->get();
            $tickets=Ticket::withTrashed()->where('learner_id',Auth::user()->account_id)->get();

            if(count($assessment) > 0){
                foreach ($assessment as $am){
                    $am->forceDelete();
                    $amcount++;
                }
            }
            else{
                $amcount=1;
            }

            if(count($award) > 0){
                foreach ($award as $aw){
                    $aw->forceDelete();
                    $awardcount++;
                }
            }
            else{
                $awardcount=1;
            }

            if(count($quiz) > 0){
                foreach ($quiz as $qz){
                    $qz->forceDelete();
                    $qcount++;
                }
            }
            else{
                $qcount=1;
            }

            if(count($tickets) > 0){
                foreach ($tickets as $tk){
                    $assignment=TicketAssignment::where('ticket_id',$tk->id)->get();
                    if(count($assignment) > 0){
                        foreach ($assignment as $as){
                            $as->forceDelete();
                        }
                        $tk->forceDelete();
                        $tcount++;
                    }
                    else{
                        $tk->forceDelete();
                        $tcount++;
                    }

                }
            }
            else{
                $tcount=1;
            }



            if(!empty($subscription->subscription_id)){
                app('App\Http\Controllers\Web\SubscriptionController')->cancel($subscription->subscription_id);
                if($subscription->forceDelete()){
                    $subdel=1;
                }
                else{
                    $subdel=0;
                }
            }
            else{
                $subdel=1;
            }
            if($subdel > 0 && $user->forceDelete() && $learner->forceDelete() && $tcount > 0 && $qcount > 0 && $awardcount > 0 && $amcount > 0){
                DB::commit();

                return redirect()->intended(url('logout'));
            }
            else{
                DB::rollBack();
                return redirect()->back()->withErrors(['Something went wrong']);
            }
        }
        elseif(session('role')=='organization'){
            $count=0;
            $depcount=0;
            $usercount=0;

            $organization = Organization::withTrashed()->where('id',Auth::user()->account_id)->first();
            $learners=$organization->learners()->get();
            $departments=Department::where('organization_id',Auth::user()->account_id)->get();
            $subscription=Subscription::where('account_id',Auth::user()->account_id)->first();
            $user=User::where('account_id',Auth::user()->account_id)->first();


            if(!empty($subscription->subscription_id)){
                app('App\Http\Controllers\Web\SubscriptionController')->cancel($subscription->subscription_id);
                if($subscription->forceDelete()){
                    $subdel=1;
                }
                else{
                    $subdel=0;
                }
            }
            else{
                $subdel=1;
            }

            if(count($learners) > 0 ){
                foreach ($learners as $learner){
                    $assessment=Assessment::where('learner_id',$learner->id)->get();
                    $award=Award::where('learner_id',$learner->id)->get();
                    $quiz=Quiz::where('learner_id',$learner->id)->get();
                    $tickets=Ticket::withTrashed()->where('learner_id',$learner->id)->get();
                    $userl=User::where('account_id',$learner->id)->get();
                    if(count($userl) > 0){
                        foreach ($userl as $le){
                            $le->forceDelete();
                            $usercount++;
                        }
                    }
                    else{
                        $usercount=1;
                    }

                    if(count($assessment) > 0){
                        foreach ($assessment as $am){
                            $am->forceDelete();
                            $amcount++;
                        }
                    }
                    else{
                        $amcount=1;
                    }

                    if(count($award) > 0){
                        foreach ($award as $aw){
                            $aw->forceDelete();
                            $awardcount++;
                        }
                    }
                    else{
                        $awardcount=1;
                    }

                    if(count($quiz) > 0){
                        foreach ($quiz as $qz){
                            $qz->forceDelete();
                            $qcount++;
                        }
                    }
                    else{
                        $qcount=1;
                    }

                    if(count($tickets) > 0){
                        foreach ($tickets as $tk){
                            $assignment=TicketAssignment::where('ticket_id',$tk->id)->get();
                            if(count($assignment) > 0){
                                foreach ($assignment as $as){
                                    $as->forceDelete();
                                }
                                $tk->forceDelete();
                                $tcount++;
                            }
                            else{
                                $tk->forceDelete();
                                $tcount++;
                            }

                        }
                    }
                    else{
                        $tcount=1;
                    }

                    if($usercount > 0 && $amcount > 0 && $qcount > 0 && $awardcount > 0 && $tcount > 0){
                        $learner->forceDelete();
                        $count++;
                    }

                }
            }
            else{
                $count=1;
            }

            if(count($departments) > 0){
                foreach ($departments as $dep){
                    $dep->forceDelete();
                    $depcount++;
                }
            }
            else{
                $depcount=1;
            }

            if($organization->forceDelete() && $subdel > 0 && $user->forceDelete() && $count > 0 && $depcount > 0){
                DB::commit();
                return redirect()->intended(url('logout'));
            }
            else{
                DB::rollBack();
                return redirect()->back()->withErrors(['Something went wrong']);
            }
        }
    }

    function resetpassword(){
        $data['page'] = 'passwordreset';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
        return view('auth.passwords.email', $data);
    }

    function sendpasslink(Request $request){

        DB::beginTransaction();

       $data=$request->all();
       $data['token']=md5(microtime());
       $user=User::where('email',$data['email'])->count();

       if(empty($data['email']))
           return redirect()->back()->withInput($request->all())->withErrors(['Email address required']);

       if($user > 0){
           $save=Password::create($data);
           if($save){
               $email['logo']=asset('assets/img/mm-logo.png');
               $email['url']=url('setpassword').'?token='.$data['token'];

               $config=new \stdClass();
               $config->from=config('constants.EMAIL_FROM');
               $config->cc=config('constants.EMAIL_BCC');
               $config->bcc=config('constants.EMAIL_CC');

               Mail::send('emails.password', $email, function($message) use($data,$config)
               {
                   $message->from($config->from,'Management Matters');
                   $message->cc($config->cc,'Samir Maikap');
                   $message->bcc($config->bcc,'Debajyoti Das');
                   $message->to($data->email);
                   $message->subject('Password reset');

               });
               if(Mail::failures()){

                   DB::rollBack();
                   return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong']);
               }
               else{
                   DB::commit();
                   return redirect()->back()->with('success', 'Password reset link has been sent');
               }
           }
           else{
               DB::rollBack();
               return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong']);
           }
       }
       else{
           return redirect()->back()->withInput($request->all())->withErrors(["Your account doesn't exist"]);
       }
    }

    function newpassword(){
        $data['page'] = 'newpassword';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
        return view('auth.passwords.reset', $data);
    }

    function setpassword(Request $request){
        DB::beginTransaction();

        $data=$request->all();

        $email=Password::where('token',$data['token'])->pluck('email')->first();
        $confirm=$data['password']==$data['password_confirmation'] ? true : false;
        if($email){
            if($confirm){
                $pass=User::where('email',$email);
                $update=$pass->update(['password'=>Hash::make($data['password'])]);
                if($update){
                    DB::commit();
                    return redirect()->intended('login');
                }
                else{
                    DB::rollBack();
                    return redirect()->back()->withInput($request->all())->withErrors(['Something went wrong']);
                }
            }
            else{
                return redirect()->back()->withInput($request->all())->withErrors(["Password doesn't match"]);
            }
        }
        else{
            return redirect()->back()->withInput($request->all())->withErrors(["your account doesn't exist"]);
        }

    }

    function resendconfirmation(){
        $id=Auth::user()->account_id;
        $user=User::where('account_id',$id)->select('verification_token','email')->get()->first();
        $data['logo']=asset('assets/img/mm-logo.png');
        if(session('role')=='learner'){
            $data['name']=Learner::find($id)->name;
        }
        else if(session('role')=='organization'){
            $data['name']=Organization::find($id)->name;
        }
        $data['url']=url('verification').'?token='.$user->verification_token;

        $config=new \stdClass();
        $config->from=config('constants.EMAIL_FROM');
        $config->cc=config('constants.EMAIL_BCC');
        $config->bcc=config('constants.EMAIL_CC');

        Mail::send('emails.confirmation', $data, function($message) use($user,$config)
        {
            $message->from($config->from,'Management Matters');
            $message->cc($config->cc,'Samir Maikap');
            $message->bcc($config->bcc,'Debajyoti Das');
            $message->to($user->email);
            $message->subject('Account verification required');
        });
        if(empty(Mail::failures())){
            return redirect()->intended('logout');
        }
    }

    function verifyemail(Request $request){

        DB::beginTransaction();

        $user=User::where('verification_token',$request->token)->first();
        if(count($user) > 0){
            $table=User::where('verification_token',$request->token);
            if( $table->update(['is_verified'=>1])){
                DB::commit();
                return redirect()->intended('login');
            }
            else{
                DB::rollBack();
                return redirect()->intended('abort');
            }
        }
    }

    public function getintouch(Request $request){

        $data['logo']=asset('assets/img/mm-logo.png');
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['emessage']=$request->message;

        $config=new \stdClass();
        $config->to=config('constants.IN_TOUCH_EMAIL');
        $config->from=config('constants.EMAIL_FROM');
        $config->cc=config('constants.EMAIL_BCC');
        $config->bcc=config('constants.EMAIL_CC');

        Mail::send('emails.getintouch', $data, function($message) use($config,$request)
        {
            $message->from($config->from,$request->name);
            $message->cc($config->cc,'Samir Maikap');
            $message->bcc($config->bcc,'Debajyoti Das');
            $message->to($config->to);
            $message->subject('Information Request');

        });

        Mail::send('emails.thankyou', $data, function($message) use($request,$config)
        {
            $message->from($config->from,'Management Matters');
            $message->cc($config->cc,'Samir Maikap');
            $message->bcc($config->bcc,'Debajyoti Das');
            $message->to($request->email);
            $message->subject('Thank you for your interest');

        });

        if(empty(Mail::failures())){
            return redirect()->back();
        }
    }
}
