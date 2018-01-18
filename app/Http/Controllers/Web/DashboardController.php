<?php

namespace App\Http\Controllers\Web;

use App\Models\Learning;
use App\Models\Ticket;
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

        $learnings = Learning::count();
        $outstandingTickets = Ticket::where('is_completed', '=', 0);
        $completed = Ticket::where('is_completed', '=', 1);
        $archivedTickets = Ticket::where('is_archived', '=', 1);
        $ticketAssignments = Ticket::where('is_archived', '=', 1);

        return view('dashboard', $data);

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
