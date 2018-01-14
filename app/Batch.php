<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class Batch extends Authenticatable
{
    use Notifiable;
    protected $table = 'batches';
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

    public function days()
    {
        return $this->belongsToMany(Day::class, 'batch_day')->withTimestamps();
    }

    
}
