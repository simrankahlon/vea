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
use App\Attendance;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
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
        
        return view('attendance.batchlist',compact('eight','ninth','tenth'));
    }

    public function createattendance(Batch $batch,$standard)
    {
        return view('attendance.add',compact('batch','standard'));
    }

    public function addattendance(Batch $batch,$standard,Request $request)
    {
        $this->validate($request,[
            'date'=>'required',
            
            ]);

        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        $attendance=new Attendance;
        $attendance->fromyear=$fromyear;
        $attendance->toyear=$toyear;
        $attendance->date=$request->date;
        $attendance->branch=$branch;
        $attendance->standard=$standard;
        $attendance->batch=$batch->batchname;
        $attendance->save();

        session()->flash('message','Attendance details added successfully!');
        return redirect('/attendance/'.$batch->id.'/'.$standard.'/listattendance');
    }

    public function listattendance(Batch $batch,$standard)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        $attendance=Attendance::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
                    ->where('batch',$batch->batchname)
                    ->where('standard',$standard)
                    ->orderBy('date', 'desc')->paginate(50);

        return view('attendance.index',compact('attendance','batch','standard'));
    }

    public function editattendance(Attendance $attendances,Batch $batch,$standard)
    {
        return view('attendance.edit',compact('attendances','batch','standard'));
    }
    
    public function updateattendance(Attendance $attendances,Batch $batch,$standard,Request $request)
    {
        $this->validate($request,[
            'date'=>'required',
            ]);

        $attendances->date=$request->date;
        $attendances->update();

        session()->flash('message','Attendance details updated successfully!');
        return redirect('/attendance/'.$batch->id.'/'.$standard.'/listattendance');
    }


    public function deleteattendance(Attendance $attendances,Batch $batch,$standard)
    {
       $attendances->delete();
       session()->flash('message','Attendance record deleted');
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
        $attendance=Attendance::where('fromyear',$fromyear)
                    ->where('toyear',$toyear)->where('date','like', $searchterm.'%')
                    ->where('branch',$branch)
                    ->where('batch',$batch->batchname)
                    ->where('standard',$standard)
                    ->orderBy('date', 'desc')->paginate(50);

        return view('attendance.index',compact('attendance','batch','standard'));
    }


    public function addstudentattendance(Attendance $attendances,Batch $batch,$standard,Request $request)
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

        return view('attendance.addstudentattendance',compact('admission','attendances','batch','standard'));
    }

    public function storestudentattendance(Attendance $attendances,Batch $batch,$standard,Request $request)
    {
        
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
                
                $exists=DB::table('admission_attendance')
                     ->where('admission_id',$request->adm[$i])
                     ->where('attendance_id',$attendances->id)
                     ->value('attendance');

                if(empty($exists))
                {

                    DB::table('admission_attendance')->insert(
                [
                    'admission_id' => $request->adm[$i], 
                    'attendance_id'=> $attendances->id,
                    'attendance'=>$att,
                    'comment'=>$request->comment[$i],
                    'created_at'=> new \DateTime(),
                    'updated_at'=> new \DateTime()
                ]);
                }
                else
                {
                    DB::table('admission_attendance')->where('admission_id',$request->adm[$i])
                     ->where('attendance_id',$attendances->id)
                     ->update(['attendance' =>$att,'comment'=>$request->comment[$i]]);
                }
        }
        return redirect('/attendance/'.$batch->id.'/'.$standard.'/listattendance');
    }

    public function liststudentattendance(Attendance $attendances,Batch $batch,$standard,Request $request)
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

        return view('attendance.liststudentattendance',compact('admission','attendances','batch','standard'));
    }

    public function summaryreportacayear($branch,Batch $batch,$standard)
    {
        $dt = Carbon::now();
        $current=$dt->format('Y'); 
        $next=$current+1;
        return view('attendance.summaryreportacayear',compact('batch','standard','branch','current','next'));
    }

    public function viewreport(Batch $batch,$standard,Request $request)
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
        
        $attendances=Attendance::where('branch',$branch)
                    ->where('batch',$batch->batchname)
                    ->where('standard',$standard)
                    ->where('fromyear',$fromyear)
                    ->where('toyear',$toyear)
                    ->orderBy('date','DESC')
                    ->get();
        
        return view('attendance.summaryreport',compact('batch','standard','admission','attendances'));
    }
}
