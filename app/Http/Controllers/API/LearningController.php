<?php

namespace App\Http\Controllers\API;

use App\Models\Learning;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Learning::all(['id', 'title', 'description', 'highlights']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $email = $request->get('email');
        $pass = $request->get('password');

        if(!Auth::attempt(['email' => $email, 'password' => $pass]))
            dd('No access');

        $data['page'] = 'learnings';
        $data['role'] = session('role');
        $data['prefix']  = session('role');
        if(isset(Auth::user()->account) && !empty(Auth::user()->account->department_id)){
            $data['learnings'] = Learning::with(['orgintro'=>function($query){
                $query->where('organization_id',Department::with('organization')->find(Auth::user()->account->department_id)->organization_id)->first();
            }])->find($id);
        }
        else{
            $data['learnings'] = Learning::find($id);
        }

        return view('learnings.single-webview', $data);

//        return Learning::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
