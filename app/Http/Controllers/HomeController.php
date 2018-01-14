<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Enquiry;
use App\Admission;
use App\Todolist;
use App\Parentsmeet;
use App\TestScheduler;
class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function selectbranchandyear()
    {
        $user_id=Auth::id();
        $user=User::find($user_id);
        if(!empty($user->default_branch) && !empty($user->default_fromyear) && !empty($user->default_toyear))
        {
            Session::put('branch',$user->default_branch);
            Session::put('fromyear',$user->default_fromyear);
            Session::put('toyear',$user->default_toyear);
            return redirect()->route('home');
        }
        else
        {
            return view('switch.selectbranchandyear',compact('user'));
        }
        
    }
    public function switchbranchandyear()
    {
        $user_id=Auth::id();
        $user=User::find($user_id);
        return view('switch.selectbranchandyear',compact('user')); 
    }

    public function setsession(Request $request)
    {
       
        $this->validate($request,[
            'from_year' => 'required',
            'to_year' => 'required',
            'branch' => 'required',
        ]);
        $user_id=Auth::id();
        
        if($request->defaultbranchandyear=="on")
        {
           
           User::where('id',$user_id)
                 ->update(['default_branch'=>$request->branch,
                            'default_fromyear'=>$request->from_year,
                            'default_toyear'=>$request->to_year                
                            ]); 
        }
        else
        {
           User::where('id',$user_id)
                  ->update(['default_branch'=>null,
                            'default_fromyear'=>null,
                            'default_toyear'=>null                
                            ]); 
        }
        Session::put('branch',$request->branch);
        Session::put('fromyear',$request->from_year);
        Session::put('toyear',$request->to_year);
        return redirect()->route('home');
    }

    public function index()
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        
        
        $enquiry = Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->orderBy('updated_at', 'desc')->limit(5)->get();
        
        $tasks = Todolist::limit(5)->get();
        $pmeet = Parentsmeet::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->orderBy('updated_at', 'desc')->limit(5)->get(); 
        $testscheduler=TestScheduler::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->orderBy('updated_at', 'desc')->limit(5)->get();
        return view('home',compact('enquiry','usercount','orientation','admission','tasks','pmeet','testscheduler'));


    }
}
