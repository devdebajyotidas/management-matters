<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $data['page'] = 'dashboard';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
        if(session('role')=='admin'){
            return view('admin.dashboard', $data);
        }
        else if(session('role')=='organization'){
            return view('organizations.dashboard', $data);
        }
        else{
            return view('dashboard', $data);
        }

    }

    public function admin()
    {
        $data['page'] = 'dashboard';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
        return view('admin.dashboard', $data);
    }

    public function learner()
    {
        $data['page'] = 'dashboard';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/' .Auth::user()->account_id;
        return view('admin.dashboard', $data);
    }

    public function organization()
    {
        $data['page'] = 'dashboard';
        $data['role'] = session('role');
        $data['prefix']  = session('role') . '/' .Auth::user()->account_id;
        return view('admin.dashboard', $data);
    }

}
