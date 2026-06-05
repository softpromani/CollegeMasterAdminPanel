<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AQARCriteria extends Model
{
   protected $guarded = [];

       public function aqar()
    {
        return $this->belongsTo(AQAR::class,'aqar_id');
    }
}
