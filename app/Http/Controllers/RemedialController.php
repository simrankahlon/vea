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
use App\RemedialBatch;
use App\RemedialAttendance;
use Illuminate\Support\Facades\DB;

class RemedialController extends Controller
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
        $eight=RemedialBatch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','VIII')->get();
        $ninth=RemedialBatch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','IX')->get();
        $tenth=RemedialBatch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','X')->get();
        
        return view('remedial.batchlist',compact('eight','ninth','tenth'));
    }

    public function createattendance(RemedialBatch $batch,$standard)
    {
        return view('remedial.add',compact('batch','standard'));
    }

    public function addattendance(RemedialBatch $batch,$standard,Request $request)
    {
        $this->validate($request,[
            'date'=>'required',
            'topic'=>'required',
            ]);

        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        $remedialatt=new RemedialAttendance;
        $remedialatt->fromyear=$fromyear;
        $remedialatt->toyear=$toyear;
        $remedialatt->date=$request->date;
        $remedialatt->branch=$branch;
        $remedialatt->standard=$standard;
        $remedialatt->batch=$batch->batchname;
        $remedialatt->topic_taken=$request->topic;
        $remedialatt->save();

        session()->flash('message','Remedial Attendance details added successfully!');
        return redirect('/remedial/'.$batch->id.'/'.$standard.'/listattendance');
    }

    public function listattendance(RemedialBatch $batch,$standard)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        $attendance=RemedialAttendance::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
                    ->where('batch',$batch->batchname)
                    ->where('standard',$standard)
                    ->orderBy('date', 'desc')->paginate(50);

        return view('remedial.index',compact('attendance','batch','standard'));
    }

    public function editattendance(RemedialAttendance $attendances,RemedialBatch $batch,$standard)
    {
        return view('remedial.edit',compact('attendances','batch','standard'));
    }
    
    public function updateattendance(RemedialAttendance $attendances,RemedialBatch $batch,$standard,Request $request)
    {
        $this->validate($request,[
            'date'=>'required',
            'topic'=>'required',
            ]);

       
        $attendances->date=$request->date;
        $attendances->topic_taken=$request->topic;
        $attendances->update();

        session()->flash('message','Remedial Attendance details updated successfully!');
        return redirect('/remedial/'.$batch->id.'/'.$standard.'/listattendance');
    }


    public function deleteattendance(RemedialAttendance $attendances,RemedialBatch $batch,$standard)
    {
       $attendances->delete();
       session()->flash('message','Attendance record deleted');
       return back(); 
    }

    public function search(RemedialBatch $batch,$standard,Request $request)
    {
        $this->validate($request,[
            'searchtxt' => 'required',
            ]);
        $searchterm=$request->searchtxt;
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $attendance=RemedialAttendance::where('fromyear',$fromyear)
                    ->where('toyear',$toyear)->where('date','like', $searchterm.'%')
                    ->where('branch',$branch)
                    ->where('batch',$batch->batchname)
                    ->where('standard',$standard)
                    ->orderBy('date', 'desc')->paginate(50);

        return view('remedial.index',compact('attendance','batch','standard'));
    }


    public function addstudentattendance(RemedialAttendance $attendances,RemedialBatch $batch,$standard,Request $request)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $admission=Admission::where('branch',$branch)
                              ->where('fromyear',$fromyear)
                              ->where('toyear',$toyear)
                              ->where('standard',$standard)
                              ->where('remedialbatch',$batch->batchname)
                              ->orderBy('studentname')
                              ->get();

        return view('remedial.addstudentattendance',compact('admission','attendances','batch','standard'));
    }

    public function storestudentattendance(RemedialAttendance $attendances,RemedialBatch $batch,$standard,Request $request)
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
                if($request->remark[$i]=='0')
                {
                    $att='PRESENT';
                }
                else
                {
                    $att=$request->remark[$i];
                }
                $exists=DB::table('admission_remedialattendance')
                     ->where('admission_id',$request->adm[$i])
                     ->where('remedialatt_id',$attendances->id)
                     ->value('attendance');

                if(empty($exists))
                {
                    DB::table('admission_remedialattendance')->insert(
                [
                    'admission_id' => $request->adm[$i], 
                    'remedialatt_id'=> $attendances->id,
                    'attendance'=>$att,
                    'created_at'=> new \DateTime(),
                    'updated_at'=> new \DateTime()
                ]);
                }
                else
                {
                    DB::table('admission_remedialattendance')->where('admission_id',$request->adm[$i])
                     ->where('remedialatt_id',$attendances->id)
                     ->update(['attendance' =>$att]);
                }
        }
        return redirect('/remedial/'.$batch->id.'/'.$standard.'/listattendance');
    }

    public function liststudentattendance(RemedialAttendance $attendances,RemedialBatch $batch,$standard,Request $request)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        $admission=Admission::where('branch',$branch)
                              ->where('fromyear',$fromyear)
                              ->where('toyear',$toyear)
                              ->where('standard',$standard)
                              ->where('remedialbatch',$batch->batchname)
                              ->orderBy('studentname')
                              ->get();
        
        return view('remedial.liststudentattendance',compact('admission','attendances','batch','standard'));
    }

    public function viewreport(RemedialBatch $batch,$standard,Request $request)
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
                              ->where('remedialbatch',$batch->batchname)
                              ->orderBy('studentname')
                              ->get();
        
        $attendances=RemedialAttendance::where('branch',$branch)
                    ->where('batch',$batch->batchname)
                    ->where('standard',$standard)
                    ->where('fromyear',$fromyear)
                    ->where('toyear',$toyear)
                    ->orderBy('date','DESC')
                    ->get();
        
        return view('remedial.summaryreport',compact('batch','standard','admission','attendances'));
    }
}
