<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\User;

class Todolist extends Authenticatable
{
    use Notifiable;
    protected $table = 'todolist';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public static function ConvertIdtoName($userid)
    {
        $username="";
        $username=User::where('id','=',$userid)->value('name');
        return $username;
    }

    
}
