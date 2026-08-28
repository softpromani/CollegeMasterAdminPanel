<?php

namespace CollegeAdmin\Models;

use Illuminate\Database\Eloquent\Model;

class EventGallery extends Model
{
    protected $guarded = [];

        public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
