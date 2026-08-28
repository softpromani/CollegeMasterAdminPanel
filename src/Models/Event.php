<?php

namespace CollegeAdmin\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

        public function galleries()
    {
        return $this->hasMany(EventGallery::class);
    }
}
