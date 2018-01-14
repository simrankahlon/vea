<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\TestScheduler;
use Carbon\Carbon;
use App\Batch;

class TestSchedulerController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('testscheduler.add');
    }

     public function index()
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $testscheduler=TestScheduler::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->orderBy('updated_at', 'desc')->paginate(50);
        return view('testscheduler.index',compact('testscheduler'));
    }

     public function filters(Request $request)
    {
        
        $this->validate($request,[
            'filters' => 'required',
            ]);
        $filter=$request->filters;
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        if($filter=='LATESTTOOLD')
        {
            $testscheduler=TestScheduler::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYVIII')
        {
            $testscheduler=TestScheduler::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','VIII')->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYIX')
        {
            $testscheduler=TestScheduler::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','IX')->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYX')
        {
            $testscheduler=TestScheduler::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','X')->orderBy('updated_at', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYIXANDX')
        {
            $testscheduler=TestScheduler::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','IX')->orWhere('standard','=','X')->orderBy('updated_at', 'desc')->paginate(50);
        }
        return view('testscheduler.index',compact('testscheduler'));
    }

    public function store(Request $request)
    {
        $testscheduler = new TestScheduler;
        $testscheduler->fromyear=Session::get('fromyear');
        $testscheduler->toyear=Session::get('toyear');
        $testscheduler->branch=Session::get('branch');
        $testscheduler->announcement_date=$request->ann_date;
        $testscheduler->standard = $request->standard;
        $testscheduler->batch=$request->batch;
        $testscheduler->test_date=$request->test_date;
        $testscheduler->portion_set=$request->portion;
        $testscheduler->marks=$request->marks;
        $testscheduler->question_paper_ready=$request->qp_ready;
        $testscheduler->xerox=$request->xerox;
        $testscheduler->correction_done_by=$request->corr_done;
        $testscheduler->distribution_date=$request->dis_date;
        $testscheduler->answer_key_uploaded=$request->an_uploaded;
        $testscheduler->msg_send=$request->msg_sent;
        $testscheduler->save();
        session()->flash('message','Test Scheduler added successfully!');
        return redirect('/testscheduler');
    }
    public function edit(TestScheduler $testscheduler)
    {
        $batch_id=Batch::where('fromyear',$testscheduler->fromyear)->where('toyear',$testscheduler->toyear)->where('branch',$testscheduler->branch)->where('batchname','=',$testscheduler->batch)->value('id');
        $batch=Batch::where('fromyear',$testscheduler->fromyear)->where('toyear',$testscheduler->toyear)->where('branch',$testscheduler->branch)->where('standard','=',$testscheduler->standard)->get();
        return view('testscheduler.edit',compact('testscheduler','batch','batch_id'));
    }
    public function update(Request $request,TestScheduler $testscheduler)
    {
        $testscheduler->fromyear=Session::get('fromyear');
        $testscheduler->toyear=Session::get('toyear');
        $testscheduler->branch=Session::get('branch');
        $testscheduler->announcement_date=$request->ann_date;
        $testscheduler->standard = $request->standard;
        $testscheduler->batch=$request->batch;
        $testscheduler->test_date=$request->test_date;
        $testscheduler->portion_set=$request->portion;
        $testscheduler->marks=$request->marks;
        $testscheduler->question_paper_ready=$request->qp_ready;
        $testscheduler->xerox=$request->xerox;
        $testscheduler->correction_done_by=$request->corr_done;
        $testscheduler->distribution_date=$request->dis_date;
        $testscheduler->answer_key_uploaded=$request->an_uploaded;
        $testscheduler->msg_send=$request->msg_sent;
        $testscheduler->update();
        session()->flash('message','Test Scheduler record updated successfully!');
        return redirect('/testscheduler');
    }

    public function delete(TestScheduler $testscheduler)
    {
       $testscheduler->delete();
       session()->flash('message','Test Scheduler record deleted');
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
        $testscheduler=TestScheduler::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('portion_set','like', $searchterm.'%')->orderBy('updated_at', 'desc')->paginate(50);

        return view('testscheduler.index',compact('testscheduler'));
    }
}
