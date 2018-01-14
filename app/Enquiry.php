<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class Enquiry extends Authenticatable
{
    use Notifiable;
    protected $table = 'enquiry';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'standard','name','school',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    
}
