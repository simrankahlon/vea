<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Batch;
use Carbon\Carbon;
use App\Schoolmark;
use App\Admission;
use Illuminate\Support\Facades\DB;

class SchoolMarksController extends Controller
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
        $eight=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('branch','BHANDUP')->where('standard','=','VIII')->get();
        $ninth=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('branch','BHANDUP')->where('standard','=','IX')->get();
        $tenth=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('branch','BHANDUP')->where('standard','=','X')->get();
        $branch='BHANDUP';
        return view('schoolmarks.batchlist',compact('eight','ninth','tenth','branch'));
    }

    public function createmarks(Batch $batch,$standard)
    {
        return view('schoolmarks.add',compact('batch','standard'));
    }

    public function addmarks(Batch $batch,$standard,Request $request)
    {
        $this->validate($request,[
            'topic_name'   =>'required',
            'portion'   =>'required',
            'total_marks'   =>'required|numeric',
            'passing_percent'   =>'required|numeric',
            ]);

        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        $passing_marks=($request->passing_percent/100)*$request->total_marks;
        
        $marks=new Schoolmark;
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
        return redirect('/schoolmarks/'.$batch->id.'/'.$standard.'/listmarks');
    }

    public function listmarks(Batch $batch,$standard)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $marks=Schoolmark::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
                    ->where('batch',$batch->batchname)
                    ->where('standard',$standard)
                    ->orderBy('date', 'desc')->paginate(50);

        return view('schoolmarks.index',compact('marks','batch','standard'));
    }

    public function editmarks(Schoolmark $marks,Batch $batch,$standard)
    {
        return view('schoolmarks.edit',compact('marks','batch','standard'));
    }
    
    public function updatemarks(Schoolmark $marks,Batch $batch,$standard,Request $request)
    {
        $this->validate($request,[
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
        return redirect('/schoolmarks/'.$batch->id.'/'.$standard.'/listmarks');
    }


    public function deletemarks(Schoolmark $marks,Batch $batch,$standard)
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
        $marks=Schoolmark::where('fromyear',$fromyear)
                    ->where('toyear',$toyear)
                    ->where('topic_name','like', $searchterm.'%')
                    ->where('branch',$branch)
                    ->where('batch',$batch->batchname)
                    ->where('standard',$standard)
                    ->orderBy('date', 'desc')->paginate(50);

        return view('schoolmarks.index',compact('marks','batch','standard'));
    }


    public function addstudentmarks(Schoolmark $marks,Batch $batch,$standard,Request $request)
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
        
        return view('schoolmarks.addstudentmarks',compact('admission','marks','batch','standard'));
    }

    public function storestudentmarks(Schoolmark $marks,Batch $batch,$standard,Request $request)
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
            
                $exists=DB::table('admission_school_marks')
                     ->where('admission_id',$request->adm[$i])
                     ->where('schoolmark_id',$marks->id)
                     ->value('schoolmarks_obtained');

                if(empty($exists))
                {
                    DB::table('admission_school_marks')->insert(
                [
                    'admission_id' => $request->adm[$i], 
                    'schoolmark_id'=> $marks->id,
                    'schoolmarks_obtained'=>$request->marks[$i],
                    'created_at'=> new \DateTime(),
                    'updated_at'=> new \DateTime()
                ]);
                }
                else
                {
                    DB::table('admission_school_marks')->where('admission_id',$request->adm[$i])
                     ->where('schoolmark_id',$marks->id)
                     ->update(['schoolmarks_obtained' =>$request->marks[$i]]);
                }
        }
        return redirect('/schoolmarks/'.$batch->id.'/'.$standard.'/listmarks');
    }

    public function liststudentmarks(Schoolmark $marks,Batch $batch,$standard,Request $request)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $admission=Admission::where('admission.branch',$branch)
                              ->where('admission.fromyear',$fromyear)
                              ->where('admission.toyear',$toyear)
                              ->where('admission.standard',$standard)
                              ->where('admission.admissionbatch',$batch->batchname)
                              ->join('admission_school_marks','admission.id','=','admission_school_marks.admission_id')
                              ->join('school_marks','school_marks.id','=','admission_school_marks.schoolmark_id')
                              ->where('school_marks.id',$marks->id)
                              ->select('admission.studentname','school_marks.date','school_marks.topic_name','admission_school_marks.schoolmarks_obtained','school_marks.total_marks','school_marks.passing_marks')
                              ->orderBy('admission.studentname')
                              ->get();

        
        return view('schoolmarks.liststudentmarks',compact('admission','marks','batch','standard'));
    }

    public function summaryreportacayear($branch,Batch $batch,$standard)
    {
        $dt = Carbon::now();
        $current=$dt->format('Y'); 
        $next=$current+1;
        return view('schoolmarks.summaryreportacayear',compact('batch','standard','branch','current','next'));
    }

    public function viewreport(Batch $batch,$standard)
    {
        
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        /*$summary=Admission::join('admission_marks','admission.id','=','admission_marks.admission_id')
                            ->join('marks','marks.id','=','admission_marks.mark_id')
                            ->where('admission.fromyear',$request->from_year)
                            ->where('admission.toyear',$request->to_year)
                            ->where('admission.branch',$branch)
                            ->where('admission.standard',$standard)
                            ->where('admission.admissionbatch',$batch->batchname)
                            ->select('admission.studentname','marks.topic_name','marks.portion','marks.total_marks','admission_marks.marks_obtained')
                            ->get();*/
        $admission=Admission::where('branch',$branch)
                              ->where('fromyear',$fromyear)
                              ->where('toyear',$toyear)
                              ->where('standard',$standard)
                              ->where('admissionbatch',$batch->batchname)
                              ->orderBy('studentname')
                              ->get();
        
        
        $marks=Schoolmark::where('branch',$branch)
                    ->where('batch',$batch->batchname)
                    ->where('standard',$standard)
                    ->where('fromyear',$fromyear)
                    ->where('toyear',$toyear)
                    ->orderBy('date','DESC')
                    ->get();
        
        return view('schoolmarks.summaryreport',compact('batch','standard','admission','marks'));
    }

    public function marks_filters(SchoolMark $marks,Batch $batch,$standard,Request $request)
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
                              ->join('admission_school_marks','admission.id','=','admission_school_marks.admission_id')
                              ->join('school_marks','school_marks.id','=','admission_school_marks.schoolmark_id')
                              ->where('school_marks.id',$marks->id)
                              ->select('admission.studentname','school_marks.date','school_marks.topic_name','admission_school_marks.schoolmarks_obtained','school_marks.total_marks','school_marks.passing_marks')
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
                              ->join('admission_school_marks','admission.id','=','admission_school_marks.admission_id')
                              ->join('school_marks','school_marks.id','=','admission_school_marks.schoolmark_id')
                              ->where('school_marks.id',$marks->id)
                              ->select('admission.studentname','school_marks.date','school_marks.topic_name','admission_school_marks.schoolmarks_obtained','school_marks.total_marks','school_marks.passing_marks')
                              ->orderBy('admission_school_marks.schoolmarks_obtained','ASC')
                              ->get();
        }
        else if($filter == 'HTOL')
        {
            $admission=Admission::where('admission.branch',$branch)
                              ->where('admission.fromyear',$fromyear)
                              ->where('admission.toyear',$toyear)
                              ->where('admission.standard',$standard)
                              ->where('admission.admissionbatch',$batch->batchname)
                              ->join('admission_school_marks','admission.id','=','admission_school_marks.admission_id')
                              ->join('school_marks','school_marks.id','=','admission_school_marks.schoolmark_id')
                              ->where('school_marks.id',$marks->id)
                              ->select('admission.studentname','school_marks.date','school_marks.topic_name','admission_school_marks.schoolmarks_obtained','school_marks.total_marks','school_marks.passing_marks')
                              ->orderBy('admission_school_marks.schoolmarks_obtained','DESC')
                              ->get();
        }
        

        return view('schoolmarks.liststudentmarks',compact('admission','marks','batch','standard'));
    }
}
