<?php

namespace App\Http\Controllers\Web;

use App\Models\Quotes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class QuotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checksub');

    }

    public function index()
    {
        $data['page'] = 'quotes';
        $data['role'] = session('role');
        $data['prefix']  = session('role');

        $data['quotes']=Quotes::orderBy('created_at','desc')->get();
        return view('controls', $data);
    }

    public function store(Request $request){
        DB::beginTransaction();

        $data['name']=$request->name;
        $result=$quotes=Quotes::create($data);
        if($result){
            DB::commit();
            return redirect()->back()->with(['success'=>'New quotes has been added']);
        }
        else{
            DB::rollBack();
            return redirect()->back()->withErrors(['Something went wrong!']);
        }
    }

    public function delete($id){
        DB::beginTransaction();

          $quotes=Quotes::find($id);
          if($quotes){
              if($quotes->is_active==1){
                  return redirect()->back()->withErrors(['Selected quotes cannot be removed as it is active']);
              }
              else{
                  if($quotes->forceDelete()){
                      DB::commit();
                      return redirect()->back()->with(['success'=>'Quotes has been deleted']);
                  }
                  else{
                      DB::rollBack();
                      return redirect()->back()->withErrors(['Something went wrong!']);
                  }
              }
          }
          else{
              return redirect()->back()->withErrors(['Something went wrong!']);
          }
    }

    function broadcast(){
        DB::beginTransaction();
        $allquotes=Quotes::all();
        if(count($allquotes) > 0){
            $randomized = $allquotes->shuffle();
            $quotes=$randomized->filter(function ($item) {
                return $item->is_active != 1;
            })->values()->first();
            $active=$randomized->filter(function ($item) {
                return $item->is_active == 1;
            })->values()->first();
            if($active){
                $active->update(['is_active'=>0]);
            }
            if($quotes){
                $update=Quotes::find($quotes->id);
                if($update->update(['is_active'=>1])){
                    DB::commit();
                    return redirect()->back()->with(['success'=>'A new quotes of the day broadcasted']);
                }
                else{
                    DB::rollBack();
                    return redirect()->back()->withErrors(['Something went wrong!']);
                }
            }
            else{
                return redirect()->back()->withErrors(['Not enough quotes to update']);
            }
        }
        else{
            return redirect()->back()->withErrors(['Not enough quotes to update']);
        }

    }

}
