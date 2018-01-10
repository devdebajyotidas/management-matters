<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        // Processing after authentication

//        dd($user->userable);
        if(isset($user->userable) && $user->userable->trashed()){
//            Auth::logout();
            return redirect()->intended('restricted');
        }else{
            if ($user->hasRole('admin')) {
                session(['role' => 'admin' ]);
            } else if ($user->hasRole('organization')) {
                session(['role' => 'organization' ]);
            } else if ($user->hasRole('learner')) {
                session(['role' => 'learner' ]);
            }
        }
    }

    public function unauthorized()
    {
        return view('errors.403');
    }
}
