<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Enquiry;
use Carbon\Carbon;

class WaitingListController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function waiting_list(Enquiry $enquiry,$check)
    {
        Enquiry::where('id',$enquiry->id)
                ->update(['waiting_list' =>$check]); 
    }

    public function view()
    {
    	$fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('waiting_list',1)->paginate(50);
    	return view('waitinglist.index',compact('enquiry'));
    }

    public function filters(Request $request)
    {
        
        $this->validate($request,[
            'filters' => 'required',
            'filters_school' => 'required',
            ]);
        $filter=$request->filters;
        $filters_school = $request->filters_school;
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        if($filter=='LATESTTOOLD')
        {
            $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('waiting_list',1)->where('school',$filters_school)->orderBy('date', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYVIII')
        {
            $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('waiting_list',1)->where('standard','=','VIII')->where('school',$filters_school)->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYIX')
        {
            $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('waiting_list',1)->where('standard','=','IX')->where('school',$filters_school)->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYX')
        {
            $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('waiting_list',1)->where('standard','=','X')->where('school',$filters_school)->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYIXANDX')
        {
            $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('waiting_list',1)->where('school',$filters_school)->where(function ($query) {
                $query->where('standard','=','X')
                      ->orWhere('standard','=','IX');
            })
            ->orderBy('updated_at', 'desc')->paginate(50);
        }
        return view('waitinglist.index',compact('enquiry'));
    }

    public function search(Request $request)
    {
        $this->validate($request,[
            'searchtxt' => 'required',
            ]);
        $searchterm=$request->searchtxt;
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('waiting_list',1)->where('name','like',$searchterm.'%')->orderBy('updated_at', 'desc')->paginate(50);

        return view('waitinglist.index',compact('enquiry'));
    }

}
