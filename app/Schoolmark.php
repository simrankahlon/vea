<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Admission;

class Schoolmark extends Authenticatable
{
    use Notifiable;
    protected $table = 'school_marks';
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
        return $this->belongsToMany(Admission::class, 'application_marks')->withPivot('schoolmarks_obtained')->withTimestamps();
    }
}
