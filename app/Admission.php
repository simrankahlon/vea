<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Fee;
use App\Mark;

class Admission extends Authenticatable
{
    use Notifiable;
    protected $table = 'admission';
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

    public function fees()
    {
        return $this->belongsTo(Fee::class);
    }

    public function marks()
    {
        return $this->belongsToMany(Mark::class, 'admission_marks')->withPivot('marks_obtained')->withTimestamps();
    }

    public function attendances()
    {
        return $this->belongsToMany(Attendance::class, 'admission_attendance')->withPivot('attendance','comment')->withTimestamps();
    }

    public function remedialattendances()
    {
        return $this->belongsToMany(RemedialAttendance::class, 'admission_remedialattendance','admission_id','remedialatt_id')->withPivot('attendance')->withTimestamps();
    }

    public function schoolmarks()
    {
        return $this->belongsToMany(Schoolmark::class, 'admission_school_marks')->withPivot('schoolmarks_obtained')->withTimestamps();
    }

    
}
