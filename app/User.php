<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Todolist;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public static function ConvertNametoId($userName)
    {
        $userid="";
        $userid=DB::table('users')->where('name','=',$userName)->value('id');
        $user=User::find( $userid);
        return $user;
    }

    public function todolists()
    {
        return $this->belongsToMany(Todolist::class)->withTimestamps();
    }
    


}
