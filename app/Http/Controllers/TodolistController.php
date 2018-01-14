<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\TodoList;


class TodolistController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('todolist/add');
    }

     public function index()
    {
        $todolist=TodoList::orderBy('updated_at', 'desc')->paginate(10);
        return view('todolist/index',compact('todolist'));
    }

    public function store(Request $request)
    {
        
        
        $this->validate($request,[
            'name' => 'required|min:3|max:50|regex:/^[\pL\s]+$/u',
            'date_assigned' => 'required',
            'task' =>'required',
            
            ]);
        $user_id=Auth::id();
        $todolist = new TodoList;
        $todolist->name = $request->name;
        $todolist->user_id=$user_id;
        $todolist->dateassigned=$request->date_assigned;
        $todolist->datecompleted=$request->datecompleted;
        $todolist->task=$request->task;
        $todolist->status=$request->status;
        $todolist->save();
        session()->flash('message','Task added successfully!');
        return redirect('/todolist');
    }
    public function edit(TodoList $todolist)
    {
        return view('todolist/edit',compact('todolist'));
    }
    public function update(Request $request,TodoList $todolist)
    {
       
        $this->validate($request,[
            'name' => 'required|min:3|max:50|regex:/^[\pL\s]+$/u',
            'date_assigned' => 'required',
            'task' =>'required',
            
            ]);
        $user_id=Auth::id();
        $todolist->name = $request->name;
        $todolist->user_id=$user_id;
        $todolist->dateassigned=$request->date_assigned;
        $todolist->datecompleted=$request->datecompleted;
        $todolist->task=$request->task;
        $todolist->status=$request->status;
        $todolist->update();
        session()->flash('message','Task record updated successfully!');
        return redirect('/todolist');
    }

    public function delete(TodoList $todolist)
    {
       $todolist->delete();
       session()->flash('message','Task record deleted');
       return back(); 
    }

    public function search(Request $request)
    {
        $this->validate($request,[
            'searchtxt' => 'required',
            ]);
        $searchterm=$request->searchtxt;
        $todolist=TodoList::where('name','like', $searchterm.'%')->orderBy('updated_at', 'desc')->paginate(10);

        return view('todolist/index',compact('todolist'));
    }
}
