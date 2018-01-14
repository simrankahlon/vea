<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Fee;
use Carbon\Carbon;

class FeeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fromyear=Session::get('fromyear');
        $toyear=Session::get('toyear');
        
        $fee=Fee::where('fromyear',$fromyear)->where('toyear',$toyear)->orderBy('updated_at', 'desc')->paginate(10);
        return view('fee.index',compact('fee'));
    }

    public function create()
    {
        
        return view('fee.add');
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'standard'=>'required',
            'cgst'=>'required|numeric',
            'sgst'=>'required|numeric',
            '1stinstallment'=>'required|numeric',
            'gst1'=>'required|numeric',
            'total1'=>'required|numeric',
            '2ndinstallment'=>'required|numeric',
            'gst2'=>'required|numeric',
            'total2'=>'required|numeric',
            '3rdinstallment'=>'required|numeric',
            'gst3'=>'required|numeric',
            'total3'=>'required|numeric',
            ]);

        $fee = new Fee;
        $fee->fromyear=Session::get('fromyear');
        $fee->toyear=Session::get('toyear');
        $fee->standard=request('standard');
        $fee->cgst=request('cgst');
        $fee->sgst=request('sgst');
        $fee->{'1stinstallment'}=request('1stinstallment');
        $fee->{'1gst'}=request('gst1');
        $fee->{'1total'}=request('total1');
        $fee->{'2ndinstallment'}=request('2ndinstallment');
        $fee->{'2gst'}=request('gst2');
        $fee->{'2total'}=request('total2');
        $fee->{'3rdinstallment'}=request('3rdinstallment');
        $fee->{'3gst'}=request('gst3');
        $fee->{'3total'}=request('total3');
        $totalinstallment=request('1stinstallment')+request('2ndinstallment')+request('3rdinstallment');
        $fee->totalinstallment=$totalinstallment;
        $totalgst=request('gst1')+request('gst2')+request('gst3');
        $fee->totalgst=$totalgst;
        $totalfee=$totalinstallment+$totalgst;
        $fee->totalfee=$totalfee;
        $fee->save();
        session()->flash('message','Fee details added!');
        
        return redirect('/fee');
    }

    public function edit(Fee $fee)
    {
        return view('fee.edit',compact('fee'));
    }

    public function update(Request $request,Fee $fee)
    {
         $this->validate($request,[
            'from_year'=>'required',
            'to_year'=>'required',
            'standard'=>'required',
            'cgst'=>'required|numeric',
            'sgst'=>'required|numeric',
            '1stinstallment'=>'required|numeric',
            'gst1'=>'required|numeric',
            'total1'=>'required|numeric',
            '2ndinstallment'=>'required|numeric',
            'gst2'=>'required|numeric',
            'total2'=>'required|numeric',
            '3rdinstallment'=>'required|numeric',
            'gst3'=>'required|numeric',
            'total3'=>'required|numeric',
            ]);
        $fee->fromyear=request('from_year');
        $fee->toyear=request('to_year');
        $fee->standard=request('standard');
        $fee->cgst=request('cgst');
        $fee->sgst=request('sgst');
        $fee->{'1stinstallment'}=request('1stinstallment');
        $fee->{'1gst'}=request('gst1');
        $fee->{'1total'}=request('total1');
        $fee->{'2ndinstallment'}=request('2ndinstallment');
        $fee->{'2gst'}=request('gst2');
        $fee->{'2total'}=request('total2');
        $fee->{'3rdinstallment'}=request('3rdinstallment');
        $fee->{'3gst'}=request('gst3');
        $fee->{'3total'}=request('total3');
        $totalinstallment=request('1stinstallment')+request('2ndinstallment')+request('3rdinstallment');
        $fee->totalinstallment=$totalinstallment;
        $totalgst=request('gst1')+request('gst2')+request('gst3');
        $fee->totalgst=$totalgst;
        $totalfee=$totalinstallment+$totalgst;
        $fee->totalfee=$totalfee;

        $fee->update();

        session()->flash('message','Fee structure details updated!');
       
        return redirect('/fee');
    }

    public function delete(Fee $fee)
    {
       $fee->delete();
       session()->flash('message','Fee structure record deleted');
       return back(); 
    }
}
