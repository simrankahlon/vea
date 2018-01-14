<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Admission;

class Fee extends Authenticatable
{
    use Notifiable;
    protected $table = 'fees';
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

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }
}
