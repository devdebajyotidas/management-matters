<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\Learner;
use App\Models\Organization;
use App\Models\User;
use App\Models\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
//            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();

        $params['user']['email']=$data['email'];
        $params['user']['password']=$data['password'];
        $params['user']['verification_token']=$vtoken=md5(microtime());

        $subscription['subscription_id']='';
        $subscription['start_date']=date('Y-m-d H:i:s');
        $subscription['status']=1;

        if($data['submit'] == 'learner')
        {
            $params['learner']['name']=$data['name'];

            $user = User::make($params['user']);
            $learner = Learner::create($params['learner']);

            if($learner->user()->save($user)) {
                $user->attachRole('learner');

                if(empty($learner->organization)){
                    $sub = Subscription::make($subscription);

                    $learner->subscription()->save($sub);
                    if(!empty($learner->name_on_card) && !empty($learner->card_number) && !empty($learner->expiry_date)){
                        $newreq= new \Illuminate\Http\Request();
                        $newreq->name_on_card=$learner->name_on_card;
                        $newreq->card_number=$learner->card_number;
                        $newreq->expiry_date=$learner->expiry_date;
                        app('App\Http\Controllers\Web\SubscriptionController')->subscribe($newreq,$learner->id);
                    }

                }

                $email['logo']=asset('assets/img/mm-logo.png');
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

                DB::commit();
            }
            else{
                DB::rollBack();

            }
        }

        if($data['submit'] == 'organization')
        {
            $params['organization']['name']=$data['name'];
            $params['organization']['contact_person']=$data['name'];

            $user = User::make($params['user']);
            $organization = Organization::create($params['organization']);

            $organization->user()->save($user);
            $user->attachRole('organization');

            $sub = Subscription::make($subscription);

            if($organization->subscription()->save($sub)){
                $email['logo']=asset('assets/img/mm-logo.png');
                $email['name']=$organization->name;
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
                DB::commit();
            }
            else{
                DB::rollBack();
            }

        }

        return $user;
    }
}
