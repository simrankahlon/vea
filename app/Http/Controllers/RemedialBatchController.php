<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Enquiry;
use App\Admission;
use App\Day;
use App\RemedialBatch;
use Carbon\Carbon;
class RemedialBatchController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $batch=RemedialBatch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->orderBy('updated_at', 'desc')->paginate(50);
        $days=Day::all();

        return view('remedialbatch.index',compact('batch','days'));


    }

    public function create()
    {
        $days=Day::all();
        return view('remedialbatch.add',compact('days'));
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'standard'=>'required',
            'bname'=>'required',
            'days'=>'required',
            'from'=>'required',
            'to'=>'required',
            'teacher_name'=>'required',
            ]);

        $batch = new RemedialBatch;
        $batch->fromyear=Session::get('fromyear');
        $batch->toyear=Session::get('toyear');
        $batch->branch=Session::get('branch');
        $batch->standard=request('standard');
        $batch->batchname=request('bname');
        $batch->start=request('from');
        $batch->end=request('to');
        $batch->start1=request('from1');
        $batch->end1=request('to1');
        $batch->teacher_name=$request->teacher_name;
        $batch->save();
        session()->flash('message','Remedial Batch details added!');
        $batch->days()->attach($request->input('days')?: []);
        return redirect('/remedialbatch');
    }

    public function edit(RemedialBatch $batch)
    {
        $days=Day::all();
        return view('remedialbatch.edit',compact('batch','days'));
    }

    public function update(Request $request,RemedialBatch $batch)
    {
         $this->validate($request,[
            'standard'=>'required',
            'from_year'=>'required',
            'to_year'=>'required',
            'branch'   =>'required',
            'bname'=>'required',
            'days'=>'required',
            'from'=>'required',
            'to'=>'required',
            'teacher_name'=>'required',
            ]);
        $batch->fromyear=$request->from_year;
        $batch->toyear=$request->to_year;
        $batch->branch=$request->branch;
        $batch->standard=request('standard');
        $batch->batchname=request('bname');
        $batch->start=request('from');
        $batch->end=request('to');
        $batch->start1=request('from1');
        $batch->end1=request('to1');
        $batch->teacher_name=request('teacher_name');
        $batch->update();

        session()->flash('message','Remedial Batch details updated!');
        $batch->days()->sync($request->input('days')?: []);
        return redirect('/remedialbatch');
    }

    public function delete(RemedialBatch $batch)
    {
       $batch->delete();
       session()->flash('message','Batch record deleted');
       return back(); 
    }

    public function filters(Request $request)
    {
        
        $this->validate($request,[
            'filters' => 'required',
            ]);
        $days=Day::all();
        $filter=$request->filters;
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        if($filter=='LATESTTOOLD')
        {
            $batch=RemedialBatch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYVIII')
        {
            $batch=RemedialBatch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','VIII')->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYIX')
        {
            $batch=RemedialBatch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','IX')->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYX')
        {
            $batch=RemedialBatch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','X')->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYIXANDX')
        {
            $batch=RemedialBatch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','IX')->orWhere('standard','=','X')->orderBy('updated_at', 'desc')->paginate(50);
        }
        return view('remedialbatch.index',compact('batch','days'));
    }

    public function search(Request $request)
    {
        $this->validate($request,[
            'searchtxt' => 'required',
            ]);
        $days=Day::all();
        $searchterm=$request->searchtxt;
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $batch=RemedialBatch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','like',$searchterm.'%')->paginate(50);

        return view('remedialbatch.index',compact('batch','days'));
    }


    public function remedial_list(Admission $admission,$check)
    {
        Admission::where('id',$admission->id)
                ->update(['remedial_list' =>$check]); 

        if($check==0)
        {
            Admission::where('id',$admission->id)->update(['remedialbatch' =>null,
                                                       'remedialbranch' =>null]);
        }
    }

}
