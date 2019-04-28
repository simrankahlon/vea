<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Enquiry;
use Carbon\Carbon;

class EnquiryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('enquiry.add');
    }

     public function index()
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('adm_id',NULL)->orderBy('updated_at', 'desc')->paginate(50);
        return view('enquiry/index',compact('enquiry'));
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
            $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('school',$filters_school)->orderBy('date', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYVIII')
        {
            $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','VIII')->where('school',$filters_school)->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYIX')
        {
            $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','IX')->where('school',$filters_school)->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYX')
        {
            $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','X')->where('school',$filters_school)->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYIXANDX')
        {
            $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('school',$filters_school)->where('date1','<>',NULL)->where(function ($query) {
                $query->where('standard','=','X')
                      ->orWhere('standard','=','IX');
            })
            ->orderBy('updated_at', 'desc')->paginate(50);
        }
        return view('enquiry/index',compact('enquiry'));
    }

    public function store(Request $request)
    {
        
        $this->validate($request,[
            'standard' => 'required',
            'date'=>'required',
            'name' => 'required|min:3|max:50|regex:/^[\pL\s]+$/u|unique:enquiry,name,fatherno,motherno',
            'school' => 'required',
            'otherschool' =>'nullable',
            'fatherno' => 'nullable|digits:10',
            'motherno' => 'nullable|digits:10',
            'landline' =>'nullable|digits:8',

            ]);
        $enquiry = new Enquiry;
        $enquiry->fromyear=Session::get('fromyear');
        $enquiry->toyear=Session::get('toyear');
        $enquiry->branch=Session::get('branch');
        $enquiry->standard = $request->standard;
        $enquiry->date=$request->date;
        $enquiry->name=$request->name;
        $enquiry->school=$request->school;
        $enquiry->otherschool=$request->otherschool;
        $enquiry->fatherno=$request->fatherno;
        $enquiry->motherno=$request->motherno;
        $enquiry->landline=$request->landline;
        $enquiry->save();
        session()->flash('message','Enquiry added successfully!');
        return redirect('/enquiry');
    }
    public function edit(Enquiry $enquiry)
    {
        return view('enquiry/edit',compact('enquiry'));
    }
    public function update(Request $request,Enquiry $enquiry)
    {
       
       $this->validate($request,[
            'from_year'=>'required',
            'to_year'=>'required',
            'branch'   =>'required',
            'standard' => 'required',
            'date'=>'required',
            'name' => 'required|min:3|max:50|regex:/^[\pL\s]+$/u',
            'school' => 'required',
            'otherschool' =>'nullable',
            'fatherno' => 'nullable|digits:10',
            'motherno' => 'nullable|digits:10',
            'landline' =>'nullable|digits:8',

            ]);
        $enquiry->fromyear=$request->from_year;
        $enquiry->toyear=$request->to_year;
        $enquiry->branch=$request->branch;
        $enquiry->standard = $request->standard;
        $enquiry->date=$request->date;
        $enquiry->name=$request->name;
        $enquiry->school=$request->school;
        $enquiry->otherschool=$request->otherschool;
        $enquiry->fatherno=$request->fatherno;
        $enquiry->motherno=$request->motherno;
        $enquiry->landline=$request->landline;
        $enquiry->update();
        session()->flash('message','Enquiry record updated successfully!');
        return redirect('/enquiry');
    }

    public function delete(Enquiry $enquiry)
    {
       $enquiry->delete();
       session()->flash('message','Enquiry record deleted');
       return back(); 
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
        $enquiry=Enquiry::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('name','like', $searchterm.'%')->orderBy('updated_at', 'desc')->paginate(50);

        return view('enquiry/index',compact('enquiry'));
    }
}
