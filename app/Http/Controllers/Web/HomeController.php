<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('home');
    }
    
    public function home()
    {
        $user = Auth::user();
        if($user)
        {
            return redirect()->intended('dashboard');

        }else{
            return redirect()->intended('/');
        }
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
         if(session('role')=='organization'){

             $data['organization']=Organization::with(['subscription'])->find(Auth::user()->account_id);
         }
         elseif(session('role')=='learner'){

         }
    }
}
