<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Batch;
use Carbon\Carbon;
use App\Mark;
use App\Admission;
use Illuminate\Support\Facades\DB;

class MarksController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function batchlist()
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $eight=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','VIII')->get();
        $ninth=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','IX')->get();
        $tenth=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','X')->get();
        return view('marks.batchlist',compact('eight','ninth','tenth'));
    }

    public function createmarks(Batch $batch,$standard)
    {
        return view('marks.add',compact('batch','standard'));
    }

    public function addmarks(Batch $batch,$standard,Request $request)
    {
        $this->validate($request,[
            'date'=>'required',
            'topic_name'   =>'required',
            'portion'   =>'required',
            'total_marks'   =>'required|numeric',
            'passing_percent'   =>'required|numeric',
            ]);

        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        $passing_marks=($request->passing_percent/100)*$request->total_marks;

        $marks=new Mark;
        $marks->fromyear=$fromyear;
        $marks->toyear=$toyear;
        $marks->date=$request->date;
        $marks->branch=$branch;
        $marks->standard=$standard;
        $marks->batch=$batch->batchname;
        $marks->topic_name=$request->topic_name;
        $marks->portion=$request->portion;
        $marks->total_marks=$request->total_marks;
        $marks->passing_percent=$request->passing_percent;
        $marks->passing_marks=$passing_marks;
        $marks->save();

        session()->flash('message','Marks details added successfully!');
        return redirect('/marks/'.$batch->id.'/'.$standard.'/listmarks');
    }

    public function listmarks(Batch $batch,$standard)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        $marks=Mark::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
                    ->where('batch',$batch->batchname)
                    ->where('standard',$standard)
                    ->orderBy('date', 'desc')->paginate(50);

        return view('marks.index',compact('marks','batch','standard'));
    }

    public function editmarks(Mark $marks,Batch $batch,$standard)
    {
        return view('marks.edit',compact('marks','batch','standard'));
    }
    
    public function updatemarks(Mark $marks,Batch $batch,$standard,Request $request)
    {
        $this->validate($request,[
            'date'=>'required',
            'topic_name'   =>'required',
            'portion'   =>'required',
            'total_marks'   =>'required|numeric',
            'passing_percent'   =>'required|numeric',
            ]);

        $passing_marks=($request->passing_percent/100)*$request->total_marks;
        
        $marks->date=$request->date;
        $marks->topic_name=$request->topic_name;
        $marks->portion=$request->portion;
        $marks->total_marks=$request->total_marks;
        $marks->passing_percent=$request->passing_percent;
        $marks->passing_marks=$passing_marks;
        $marks->update();

        session()->flash('message','Marks details updated successfully!');
        return redirect('/marks/'.$batch->id.'/'.$standard.'/listmarks');
    }


    public function deletemarks(Mark $marks,Batch $batch,$standard)
    {
       $marks->delete();
       session()->flash('message','Marks record deleted');
       return back(); 
    }

    public function search(Batch $batch,$standard,Request $request)
    {
        $this->validate($request,[
            'searchtxt' => 'required',
            ]);
        $searchterm=$request->searchtxt;
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $marks=Mark::where('fromyear',$fromyear)
                    ->where('toyear',$toyear)
                    ->where('topic_name','like', $searchterm.'%')
                    ->where('branch',$branch)
                    ->where('batch',$batch->batchname)
                    ->where('standard',$standard)
                    ->orderBy('date', 'desc')->paginate(50);

        return view('marks.index',compact('marks','batch','standard'));
    }


    public function addstudentmarks(Mark $marks,Batch $batch,$standard,Request $request)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $admission=Admission::where('branch',$branch)
                              ->where('fromyear',$fromyear)
                              ->where('toyear',$toyear)
                              ->where('standard',$standard)
                              ->where('admissionbatch',$batch->batchname)
                              ->orderBy('studentname')
                              ->get();

        return view('marks.addstudentmarks',compact('admission','marks','batch','standard'));
    }

    public function storestudentmarks(Mark $marks,Batch $batch,$standard,Request $request)
    {
        /*$mark=DB::table('admission_marks')
                  ->where('admission_id',$admission->id)
                  ->where('mark_id',$marks->id)
                  ->value('marks_obtained');
        echo "helo".$mark;

        if(is_null($mark) or $mark=='')
        {
            $admission->marks()->attach($marks, ['marks_obtained'=>$marks_obtained]);
        }
        else
        {
            DB::table('admission_marks')
                  ->where('admission_id',$admission->id)
                  ->where('mark_id',$marks->id)
                  ->update(['marks_obtained' =>$marks_obtained]);
        }*/

        $count = sizeof($request->adm);
        for($i = 0; $i < $count; $i ++)
        {   
            
                $exists=DB::table('admission_marks')
                     ->where('admission_id',$request->adm[$i])
                     ->where('mark_id',$marks->id)
                     ->value('marks_obtained');

                if(empty($exists))
                {
                    DB::table('admission_marks')->insert(
                [
                    'admission_id' => $request->adm[$i], 
                    'mark_id'=> $marks->id,
                    'marks_obtained'=>$request->marks[$i],
                    'created_at'=> new \DateTime(),
                    'updated_at'=> new \DateTime()
                ]);
                }
                else
                {
                    DB::table('admission_marks')->where('admission_id',$request->adm[$i])
                     ->where('mark_id',$marks->id)
                     ->update(['marks_obtained' =>$request->marks[$i]]);
                }
        }
        return redirect('/marks/'.$batch->id.'/'.$standard.'/listmarks');
    }

    public function liststudentmarks(Mark $marks,Batch $batch,$standard,Request $request)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        $admission=Admission::where('admission.branch',$branch)
                              ->where('admission.fromyear',$fromyear)
                              ->where('admission.toyear',$toyear)
                              ->where('admission.standard',$standard)
                              ->where('admission.admissionbatch',$batch->batchname)
                              ->join('admission_marks','admission.id','=','admission_marks.admission_id')
                              ->join('marks','marks.id','=','admission_marks.mark_id')
                              ->where('marks.id',$marks->id)
                              ->select('admission.studentname','marks.date','marks.topic_name','admission_marks.marks_obtained','marks.total_marks','marks.passing_marks')
                              ->orderBy('admission.studentname')
                              ->get();

        return view('marks.liststudentmarks',compact('admission','marks','batch','standard'));
    }

    public function summaryreportacayear($branch,Batch $batch,$standard)
    {
        $dt = Carbon::now();
        $current=$dt->format('Y'); 
        $next=$current+1;
        return view('marks.summaryreportacayear',compact('batch','standard','branch','current','next'));
    }

    public function viewreport(Batch $batch,$standard)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        /*$summary=Admission::join('admission_marks','admission.id','=','admission_marks.admission_id')
                            ->join('marks','marks.id','=','admission_marks.mark_id')
                            ->where('admission.fromyear',$fromyear)
                            ->where('admission.toyear',$toyear)
                            ->where('admission.branch',$branch)
                            ->where('admission.standard',$standard)
                            ->where('admission.admissionbatch',$batch->batchname)
                            ->select('admission.studentname','marks.topic_name','marks.portion','marks.total_marks','admission_marks.marks_obtained')
                            ->get();
        return $summary;*/
        $admission=Admission::where('branch',$branch)
                              ->where('fromyear',$fromyear)
                              ->where('toyear',$toyear)
                              ->where('standard',$standard)
                              ->where('admissionbatch',$batch->batchname)
                              ->orderBy('studentname')
                              ->get();
        
        $marks=Mark::where('branch',$branch)
                    ->where('batch',$batch->batchname)
                    ->where('standard',$standard)
                    ->where('fromyear',$fromyear)
                    ->where('toyear',$toyear)
                    ->orderBy('date','DESC')
                    ->get();
        
        return view('marks.summaryreport',compact('batch','standard','admission','marks'));
    }

    public function marks_filters(Mark $marks,Batch $batch,$standard,Request $request)
    {
        $this->validate($request,[
            'filters' => 'required',
            ]);
        $filter=$request->filters;
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        if($filter=='Default')
        {
            $admission=Admission::where('admission.branch',$branch)
                              ->where('admission.fromyear',$fromyear)
                              ->where('admission.toyear',$toyear)
                              ->where('admission.standard',$standard)
                              ->where('admission.admissionbatch',$batch->batchname)
                              ->join('admission_marks','admission.id','=','admission_marks.admission_id')
                              ->join('marks','marks.id','=','admission_marks.mark_id')
                              ->where('marks.id',$marks->id)
                              ->select('admission.studentname','marks.date','marks.topic_name','admission_marks.marks_obtained','marks.total_marks','marks.passing_marks')
                              ->orderBy('admission.studentname')
                              ->get();
        }
        else if($filter == 'LTOH')
        {
            $admission=Admission::where('admission.branch',$branch)
                              ->where('admission.fromyear',$fromyear)
                              ->where('admission.toyear',$toyear)
                              ->where('admission.standard',$standard)
                              ->where('admission.admissionbatch',$batch->batchname)
                              ->join('admission_marks','admission.id','=','admission_marks.admission_id')
                              ->join('marks','marks.id','=','admission_marks.mark_id')
                              ->where('marks.id',$marks->id)
                              ->select('admission.studentname','marks.date','marks.topic_name','admission_marks.marks_obtained','marks.total_marks','marks.passing_marks')
                              ->orderBy('admission_marks.marks_obtained','ASC')
                              ->get();
        }
        else if($filter == 'HTOL')
        {
            $admission=Admission::where('admission.branch',$branch)
                              ->where('admission.fromyear',$fromyear)
                              ->where('admission.toyear',$toyear)
                              ->where('admission.standard',$standard)
                              ->where('admission.admissionbatch',$batch->batchname)
                              ->join('admission_marks','admission.id','=','admission_marks.admission_id')
                              ->join('marks','marks.id','=','admission_marks.mark_id')
                              ->where('marks.id',$marks->id)
                              ->select('admission.studentname','marks.date','marks.topic_name','admission_marks.marks_obtained','marks.total_marks','marks.passing_marks')
                              ->orderBy('admission_marks.marks_obtained','DESC')
                              ->get();
        }
        

        return view('marks.liststudentmarks',compact('admission','marks','batch','standard'));
    }
}
