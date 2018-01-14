<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Admission;

class Mark extends Authenticatable
{
    use Notifiable;
    protected $table = 'marks';
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
        return $this->belongsToMany(Admission::class, 'admission_marks')->withPivot('marks_obtained')->withTimestamps();
    }
}
