<?php

namespace App\Http\Controllers;
use App\Client;
use App\Role;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use Validator;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::paginate(50);
        return view('users.index',compact('users'));
    }

    public  function create()
    {
        return view('users.add');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:10|max:'.config('global.maxlength'),
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed|max:'.config('global.passlength'),
            'password_confirmation' => 'required|min:6|max:'.config('global.passlength'),
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); 
        $user->save();
       /* $user->assignRole('consultant');*/
        session()->flash('message','User created');
        return redirect('/users');
    }
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:10|max:'.config('global.maxlength'),
            
            
        ]);
        //return $request->password != null;
      
        $validator->sometimes('password', 'required|min:6|confirmed|max:'.config('global.passlength'), function ($input)use($request) {
            if($request->password != null){
                return "True";
            }
        });

        $validator->validate();

        

         $user->name = $request->name;
        if($request->password != null){
            if($request->password == $request->password_confirmation){
                $user->password = bcrypt($request->password);
            }
        }
        $user->save();
        session()->flash('message','User record updated');
        return redirect('/users/');
        //http://localhost:8000/clients/1/applications
        //return $application;
    }

    public function delete(User $user)
    {
       $user->delete();
       session()->flash('message','User record deleted');
       return back(); 
    }
}
