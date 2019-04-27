<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Admission;

class Attendance extends Authenticatable
{
    use Notifiable;
    protected $table = 'attendance';
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
        return $this->belongsToMany(Admission::class, 'admission_attendance')->withPivot('attendance','comment')->withTimestamps();
    }
}
