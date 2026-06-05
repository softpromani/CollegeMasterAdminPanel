<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AQAR extends Model
{
    protected $guarded = [];

        public function criterias()
    {
        return $this->hasMany(AQARCriteria::class,'aqar_id');
    }
}
