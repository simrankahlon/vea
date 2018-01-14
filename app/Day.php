<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class Day extends Authenticatable
{
    use Notifiable;
    protected $table = 'days';
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

    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'batch_day')->withTimestamps();
    }

    public function remedialbatches()
    {
        return $this->belongsToMany(RemedialBatch::class, 'remedialbatches_day')->withTimestamps();
    }

    
}
