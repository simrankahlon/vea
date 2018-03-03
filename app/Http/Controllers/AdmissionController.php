<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Enquiry;
use App\Admission;
use App\Batch;
use App\Fee;
use \PDF;
use Mail;
use File;
use Carbon\Carbon;
use App\Receipt;
use Hash;
use App\RemedialBatch;
use App\Mark;
use App\Attendance;
use App\Schoolmark;
use App\RemedialAttendance;

class AdmissionController extends Controller
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
       
        $eight=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','VIII')->get();
        $ninth=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','IX')->get();
        $tenth=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','X')->get();

        return view('admission.index',compact('eight','ninth','tenth'));
    }

    public function create()
    {
        $check=1;
        return view('admission.add',compact('check'));
    }

    public function createthroughenquiry(Enquiry $enquiry)
    {
        $check=2;
        return view('admission.add',compact('enquiry','check'));
    }

    public function standard($standard,$branch,$fromyear,$toyear)
    {
        
        $batch=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
                      ->where('standard','=',$standard)->get();
        return \Response::json($batch);
    }

    public function batch($batch,$standard,$branch,$fromyear,$toyear)
    {
       $batchname=$batch;
       
       $batch=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
        ->where('batchname','=',$batchname)
        ->where('standard','=',$standard)
        ->join('batch_day','batches.id','=','batch_day.batch_id')
        ->join('days','days.id','=','batch_day.day_id')
        ->select('days.days')
        ->get();

        $batchcount=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
        ->where('batchname','=',$batchname)
        ->where('standard','=',$standard)
        ->join('batch_day','batches.id','=','batch_day.batch_id')
        ->join('days','days.id','=','batch_day.day_id')
        ->select('days.days')
        ->count();
        
        /*$days="";*/
        /*foreach($batch as $bat)
        { 
            $days=$days.' '.$bat->days;

        }*/
        $day1=$batch[0]->days;
        $day2="";
        $timings1="";
        if($batchcount==2)
        {
            $day2=$batch[1]->days;
        }
        
        $day2exists=0;

        if(!(empty($day2)))
        {
            $start1=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
            ->where('batchname','=',$batchname)
            ->where('standard','=',$standard)
            ->value('start1');
            $end1=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$batchname)
            ->where('standard','=',$standard)
            ->value('end1');
            $timings1=$start1.' - '.$end1;
            $day2exists=1;
        }

        $start=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
        ->where('batchname','=',$batchname)
        ->where('standard','=',$standard)
        ->value('start');
        $end=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$batchname)
        ->where('standard','=',$standard)
        ->value('end');
       
        
        $timings=$start.' - '.$end;

         $data = ([
            'day1'=> $day1,
            'day2'=> $day2,
            'timings'=> $timings,
            'timings1'=> $timings1,
            'day2exists'=>$day2exists
            ]);
        return \Response::json($data);
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'from_year'=>'required',
            'to_year'=>'required',
            'branch'   =>'required',
            'date'=>'required',
            'name' => 'required|min:3|max:50|regex:/^[\pL\s]+$/u',
            'address'=>'required',
            'school' => 'required',
            'otherschool' =>'nullable',
            'fatherno' => 'nullable|digits:10',
            'motherno' => 'nullable|digits:10',
            'whatsapptext' =>'required',
            'landline' =>'nullable|digits:8',
            'email'    =>'nullable|email',
            'standard'=>'required',
            'admbatch'=>'required',
            'timings'=>'required',
            'days'=>'required',
            'student_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1500',
            ]);

        $fee_id=Fee::where('standard','=',$request->standard)
                     ->where('fromyear','=',$request->from_year)
                     ->where('toyear','=',$request->to_year)
                     ->value('id');

        $check=$request->enquirycheck;

        $admission=new Admission;
        $admission->fromyear=$request->from_year;
        $admission->toyear=$request->to_year;
        $admission->branch=$request->branch;
        $admission->date=$request->date;
        $admission->studentname=$request->name;
        $admission->address=$request->address;
        $admission->school=$request->school;
        $admission->otherschool=$request->otherschool;
        $admission->fatherno=$request->fatherno;
        $admission->motherno=$request->motherno;
        $admission->whatsappon=$request->whatsapptext;
        $admission->landline=$request->landline;
        $admission->email=$request->email;
        $admission->standard=$request->standard;
        $admission->admissionbatch=$request->admbatch;
        $admission->timing1=$request->timings;
        $admission->day1=$request->days;
        $admission->timing2=$request->timings1;
        $admission->day2=$request->days1;
        $admission->parentname=$request->pname;
        $admission->occupation=$request->occupation;
        $admission->officeaddress=$request->oaddress;
        $admission->officenumber=$request->onumber;
        $admission->lasttermpercent=$request->lasttermpercent;
        $admission->english1=$request->english1;
        $admission->english2=$request->english2;
        $admission->overallpercent=$request->overallpercent;
        $admission->fee_id=$fee_id;
        $admission->save();
        if($request->file('student_image')!="")
        {
            $file = $request->file('student_image');
            $fileName = $admission->id.'-'.$admission->studentname.'-'.$admission->fromyear.'-'.$admission->toyear.'.jpg';
            $destinationPath = public_path().'/studentimages/';
            $file->move($destinationPath,$fileName);
            $admission->studentimage=$fileName;
            $admission->update();
        }
        

        if($check==2)
        {
            $enquiry_id=$request->enquiryid;
            Enquiry::where('id',$enquiry_id)->update(['adm_id' =>$admission->id,'waiting_list' =>0]);

        }

        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        session()->flash('message','Admission record added successfully!');
        $batch_id=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');
        $standard=$admission->standard;
        return redirect('/batch/'.$batch_id.'/'.$standard.'/admission');
    }

    public function list(Admission $admission)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $batch=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');
        return view('admission.list',compact('admission','batch'));
    }

    public function edit(Admission $admission)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $batch_id=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');
        $batch=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=',$admission->standard)->get();
        return view('admission.edit',compact('admission','batch','batch_id'));
    }

    public function update(Request $request,Admission $admission)
    {
         $this->validate($request,[
            'from_year'=>'required',
            'to_year'=>'required',
            'branch'   =>'required',
            'date'=>'required',
            'name' => 'required|min:3|max:50|regex:/^[\pL\s]+$/u',
            'address'=>'required',
            'school' => 'required',
            'otherschool' =>'nullable',
            'fatherno' => 'nullable|digits:10',
            'motherno' => 'nullable|digits:10',
            'whatsapptext' =>'required',
            'landline' =>'nullable|digits:8',
            'email'    =>'nullable|email',
            'standard'=>'required',
            'admbatch'=>'required',
            'timings'=>'required',
            'days'=>'required',
            'student_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1500',
            ]);

         $fee_id=Fee::where('standard','=',$request->standard)
                     ->where('fromyear','=',$request->from_year)
                     ->where('toyear','=',$request->to_year)
                     ->value('id');
        
         $admission->fromyear=$request->from_year;
         $admission->toyear=$request->to_year;
         $admission->branch=$request->branch;
         $admission->date=$request->date;
         $admission->studentname=$request->name;
         $admission->address=$request->address;
         $admission->school=$request->school;
         $admission->otherschool=$request->otherschool;
         $admission->fatherno=$request->fatherno;
         $admission->motherno=$request->motherno;
         $admission->whatsappon=$request->whatsapptext;
         $admission->landline=$request->landline;
         $admission->email=$request->email;
         $admission->standard=$request->standard;
         $admission->admissionbatch=$request->admbatch;
         $admission->timing1=$request->timings;
         $admission->day1=$request->days;
         $admission->timing2=$request->timings1;
         $admission->day2=$request->days1;
         $admission->parentname=$request->pname;
         $admission->occupation=$request->occupation;
         $admission->officeaddress=$request->oaddress;
         $admission->officenumber=$request->onumber;
         $admission->lasttermpercent=$request->lasttermpercent;
         $admission->english1=$request->english1;
         $admission->english2=$request->english2;
         $admission->overallpercent=$request->overallpercent;
         $admission->fee_id=$fee_id;
         if($admission->studentimage!="")
         {
            $fileexists=$admission->studentimage;
            $path=public_path().'/studentimages/'.$fileexists;
            File::delete($path);
         }

         if($request->file('student_image')!="")
         {
            $file = $request->file('student_image');
            $fileName = $admission->id.'-'.$admission->studentname.'-'.$admission->fromyear.'-'.$admission->toyear.'.jpg';
            $destinationPath = public_path().'/studentimages/';
            $file->move($destinationPath,$fileName);
            $admission->studentimage=$fileName;
         }

            $admission->update();

        session()->flash('message','Admission record updated successfully!');
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $batch_id=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');
        $standard=$admission->standard;
        return redirect('/batch/'.$batch_id.'/'.$standard.'/admission');
    }

    public function delete(Admission $admission)
    {
       $admission->delete();
       session()->flash('message','Admission record deleted');
       return back(); 
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
            $admission=Admission::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->orderBy('date', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYVIII')
        {
            $admission=Admission::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','VIII')->orderBy('date', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYIX')
        {
            $admission=Admission::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','IX')->orderBy('date', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYX')
        {
            $admission=Admission::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','X')->orderBy('date', 'desc')->paginate(50);
        }
        elseif($filter=='ONLYIXANDX')
        {
            $admission=Admission::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('standard','=','IX')->orWhere('standard','=','X')->orderBy('date', 'desc')->paginate(50);
        }


        return view('admission.index',compact('admission'));
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
        $admission=Admission::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('studentname','like',$searchterm.'%')
        ->where('admissionbatch','=',$batch->batchname)
        ->where('standard','=',$standard)
        ->orderBy('studentname')->paginate(50);
       
        return view('admission.admissionbatchlist',compact('admission','standard','batch'));
    }

    public function admissionsview(Batch $batch,$standard)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $admission=Admission::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('admissionbatch','=',$batch->batchname)
        ->where('standard','=',$standard)
        ->orderBy('studentname')->paginate(50);
       
        return view('admission.admissionbatchlist',compact('admission','standard','batch'));
    }

    public function fee(Admission $admission,$installment)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $batch_id=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');
        $batch=Batch::find($batch_id);
        $fee=Fee::where('fromyear',$fromyear)->where('toyear',$toyear)->where('standard','=',$admission->standard)->where('id',$admission->fee_id)->get();
        return view('admission.feeadd',compact('admission','installment','fee','batch'));
    }

    public function feeadd(Admission $admission,$installment,Request $request)
    {
        
        $this->validate($request,[
            'date' => 'required',
            'serialno' => 'required',
            'paymentmode'=>'required',
            ]);
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $paymentmode=$request->paymentmode;
        $installment=$installment;

        if($admission["receipt_no".$installment]==null)
        {
            $number=Receipt::where('fromyear',$fromyear)->where('toyear',$toyear)->value('number');

            if($number==null)
            {
                $number=1;
                $receipt=new Receipt;
                $receipt->fromyear=$fromyear;
                $receipt->toyear=$toyear;
                $request->number=$number;
                $receipt->save();
            }
            else
            {
                $number=$number+1;
            }

            Receipt::where('fromyear',$fromyear)->where('toyear',$toyear)->update(['number' =>$number]);

            $receipt_id=$request->serialno.'-'.$fromyear.'-'.$toyear.'-'.$number;
        }
        else
        {
            $receipt_id=$admission["receipt_no".$installment];
        }
        

        if($paymentmode=='CASH')
        {
            $admission["installment_date".$installment]=$request->date;
            $admission["installment_mode".$installment]=$request->paymentmode;
            $admission["serial_no".$installment]=$request->serialno;
            $admission["receipt_no".$installment]=$receipt_id;
            $admission["bank".$installment]="";
            $admission["branch".$installment]="";
            $admission["chequeno".$installment]="";
            $admission["transactionid".$installment]="";
            $admission["bank_transactionid".$installment]="";
        }
        elseif($paymentmode=='CHEQUE')
        {
            $admission["installment_date".$installment]=$request->date;
            $admission["installment_mode".$installment]=$request->paymentmode;
            $admission["serial_no".$installment]=$request->serialno;
            $admission["bank".$installment]=$request->bank;
            $admission["branch".$installment]=$request->branch;
            $admission["chequeno".$installment]=$request->chequeno;
            $admission["receipt_no".$installment]=$receipt_id;
            $admission["transactionid".$installment]="";
            $admission["bank_transactionid".$installment]="";
        }
        elseif($paymentmode=='ONLINEPAYMENT')
        {
            $admission["installment_date".$installment]=$request->date;
            $admission["installment_mode".$installment]=$request->paymentmode;
            $admission["serial_no".$installment]=$request->serialno;
            $admission["transactionid".$installment]=$request->transactionid;
            $admission["bank_transactionid".$installment]=$request->transaction_bank;
            $admission["receipt_no".$installment]=$receipt_id;
            $admission["bank".$installment]="";
            $admission["branch".$installment]="";
            $admission["chequeno".$installment]="";
        }
        $admission->update();
        
        session()->flash('message','Fee record updated!');
        $batch_id=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');
        return redirect('/batch/'.$batch_id.'/'.$admission->standard.'/admission');
    }

    public function viewfeereceipt(Admission $admission,$installment)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $batch_id=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');
        $batch=Batch::find($batch_id);
        $fee=Fee::where('fromyear',$fromyear)->where('toyear',$toyear)->where('standard','=',$admission->standard)->get();
        return view('pdf.receiptview',compact('admission','installment','fee','batch'));
    }

    public function downloadreceipt(Admission $admission,$installment)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $batch_id=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');
        $batch=Batch::find($batch_id);
        $fee=Fee::where('fromyear',$fromyear)->where('toyear',$toyear)->where('standard','=',$admission->standard)->get();
        $header = \View::make('layouts.pdfheader',compact('admission'))->render();
        $footer = \View::make('layouts.pdffooter')->render();
        $pdf = PDF::loadView('pdf.receipt', compact('admission','installment','fee','batch'))
                  ->setOption('header-html',$header)
                  ->setOption('footer-html',$footer);
        //return view('pdf.receipt',compact('admission','installment','fee','batch'));
        return $pdf->download($admission->studentname.'.pdf');
    }

    public function emailreceipt(Admission $admission,$installment)
    {
        if($admission->email!=null)
        {

        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $storage_path = storage_path();
        $batch_id=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');
        $batch=Batch::find($batch_id);
        $fee=Fee::where('fromyear',$fromyear)->where('toyear',$toyear)->where('standard','=',$admission->standard)->get();
        $header = \View::make('layouts.pdfheader',compact('admission'))->render();
        $footer = \View::make('layouts.pdffooter')->render();
        $pdf = PDF::loadView('pdf.receipt', compact('admission','installment','fee','batch'))
                  ->setOption('header-html',$header)
                  ->setOption('footer-html',$footer);

        $pdf->save($storage_path.'/receipts/'.$admission->studentname.'.pdf');
        
        try
        {
        Mail::send('email.feereceipt', ['title' => "", 'content' => ""], function ($message) use ($admission,$installment,$storage_path)
                {
                    $message->from('veaenglishacademy@gmail.com', 'VEA Team')
                            ->to($admission->email)
                            ->subject('Installment Receipt')
                            ->attach($storage_path.'/receipts/'.$admission->studentname.'.pdf', [
                            'as' => $admission->studentname.'.pdf', 
                            'mime' => 'application/pdf'
                ]);

                });
        File::delete($storage_path.'/receipts/'.$admission->studentname.'.pdf');
        session()->flash('message','Email send successfully!');
        return back();
        }
        catch(\Swift_TransportException $e)
        {
            File::delete($storage_path.'/receipts/'.$admission->studentname.'.pdf');
            session()->flash('message','Email was not send , due to some techical issues .');
            return back();
        }
        
    }
    else
    {
        session()->flash('message','Email was not send , since no email id is present in the records');
        return back();
    }
    }

    public function feecheck($standard,$fromyear,$toyear)
    {
        
        $fee_id=Fee::where('standard','=',$standard)
                     ->where('fromyear','=',$fromyear)
                     ->where('toyear','=',$toyear)
                     ->value('id');
        $check="";

        if($fee_id=="")
        {
            $check=0;
        }
        else
        {
            $check=1;
        }
        return \Response::json($check);

    }

    public function transferadm(Admission $admission)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        $batch_id=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');

        return view('admission.transfer',compact('admission','batch_id'));
    }

    public function addtransfer(Admission $admission,Request $request)
    {
        $this->validate($request,[
            'from_year'=>'required',
            'to_year'=>'required',
            'branch'   =>'required',
            'date'=>'required',
            'standard'=>'required',
            'admbatch'=>'required',
            'timings'=>'required',
            'days'=>'required',
            ]);

        $fee_id=Fee::where('standard','=',$request->standard)
                     ->where('fromyear','=',$request->from_year)
                     ->where('toyear','=',$request->to_year)
                     ->value('id');
        
        
        $admission1=new Admission;
        $admission1->fromyear=$request->from_year;
        $admission1->toyear=$request->to_year;
        $admission1->branch=$request->branch;
        $admission1->date=$request->date;
        $admission1->studentname=$admission->studentname;
        $admission1->address=$admission->address;
        $admission1->school=$admission->school;
        $admission1->otherschool=$admission->otherschool;
        $admission1->fatherno=$admission->fatherno;
        $admission1->motherno=$admission->motherno;
        $admission1->whatsappon=$admission->whatsappon;
        $admission1->landline=$admission->landline;
        $admission1->email=$admission->email;
        $admission1->standard=$request->standard;
        $admission1->admissionbatch=$request->admbatch;
        $admission1->timing1=$request->timings;
        $admission1->day1=$request->days;
        $admission1->timing2=$request->timings1;
        $admission1->day2=$request->days1;
        $admission1->parentname=$admission->pname;
        $admission1->occupation=$admission->occupation;
        $admission1->officeaddress=$admission->oaddress;
        $admission1->officenumber=$admission->onumber;
        $admission1->lasttermpercent=$admission->lasttermpercent;
        $admission1->english1=$admission->english1;
        $admission1->english2=$admission->english2;
        $admission1->overallpercent=$admission->overallpercent;
        $admission1->fee_id=$fee_id;
        $admission1->save();


        if($admission->studentimage!="")
        {
           $fileexists=$admission->studentimage;
           $path=public_path().'/studentimages/'.$fileexists;
           $fileName = $admission1->id.'-'.$admission1->studentname.'-'.$admission1->fromyear.'-'.$admission1->toyear.'.jpg';
           $destinationPath = public_path().'/studentimages/'.$fileName;
           File::copy($path,$destinationPath);
           $admission1->studentimage=$fileName;
        }
           $admission1->update();

        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        session()->flash('message','Admission record added successfully!');
        $batch_id=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');
        $standard=$admission->standard;
        return redirect('/batch/'.$batch_id.'/'.$standard.'/admission');
    }

    public function remedialdetails(Admission $admission)
    {
        $batch =RemedialBatch::where('fromyear',$admission->fromyear)->where('toyear',$admission->toyear)->where('branch',$admission->branch)->get();
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');
        $batch_id=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');
        return view('admission.remedialdetails',compact('admission','batch','batch_id'));
    }

    public function storeremedialdetails(Admission $admission,Request $request)
    {
        $this->validate($request,[
            'branch'   =>'required',
            'batch'=>'required',
            ]);

        Admission::where('id',$admission->id)->update(['remedialbatch' =>$request->batch,
                                                       'remedialbranch' =>$request->branch]);

        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        $batch_id=Batch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)->where('batchname','=',$admission->admissionbatch)->value('id');
        $standard=$admission->standard;
        return redirect('/batch/'.$batch_id.'/'.$standard.'/admission');


    }

    public function remedialbatch($standard,$branch,$fromyear,$toyear)
    {
        
        $batch=RemedialBatch::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
                      ->where('standard','=',$standard)->get();
        return \Response::json($batch);
    }

    public function report(Admission $admission)
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        $branch=Session::get('branch');

        $enquiry=Enquiry::where('adm_id',$admission->id)->first();
        if($enquiry!=null)
        {
            $has_enquiry=1;
        }
        else
        {
            $has_enquiry=0;
        }
        $marks=Mark::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
                    ->where('batch',$admission->admissionbatch)
                    ->where('standard',$admission->standard)
                    ->get();

        $schoolmarks=Schoolmark::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
                    ->where('batch',$admission->admissionbatch)
                    ->where('standard',$admission->standard)
                    ->get();

        $attendancecount=Attendance::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$branch)
                    ->where('batch',$admission->admissionbatch)
                    ->where('standard',$admission->standard)
                    ->count();

        $attended=Admission::where('id',$admission->id)
                            ->join('admission_attendance','admission.id','=','admission_attendance.admission_id')
                            ->where('admission_attendance.attendance','<>','ABSENT')
                            ->count();

        $remedialattendance=0;
        $remedialattended=0;

        if($admission->remedial_list==1)
        {
            $remedialattendance=RemedialAttendance::where('fromyear',$fromyear)->where('toyear',$toyear)->where('branch',$admission->remedialbranch)
                        ->where('batch',$admission->remedialbatch)
                        ->where('standard',$admission->standard)
                        ->count();

            $remedialattended=Admission::where('id',$admission->id)
                                ->join('admission_remedialattendance','admission.id','=','admission_remedialattendance.admission_id')
                                ->where('admission_remedialattendance.attendance','<>','ABSENT')
                                ->count();
        }

        $header = \View::make('layouts.pdfheader',compact('admission'))->render();
        $footer = \View::make('layouts.pdffooter')->render();

        $pdf = PDF::loadView('pdf.studentreport',compact('admission','has_enquiry','marks','schoolmarks','attendancecount','enquiry','attended','remedialattendance','remedialattended'))
        ->setOption('header-html',$header)
        ->setOption('footer-html',$footer);

        return $pdf->inline($admission->studentname.'.pdf');
        
    }

}
