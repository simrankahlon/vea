<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Admission;

class RemedialAttendance extends Authenticatable
{
    use Notifiable;
    protected $table = 'remedialattendance';
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

    public function remedialadmissions()
    {
        return $this->belongsToMany(Admission::class, 'admission_remedialattendance')->withPivot('attendance')->withTimestamps();
    }
}
