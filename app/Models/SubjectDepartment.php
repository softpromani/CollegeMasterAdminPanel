<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectDepartment extends Model
{
    protected $guarded = [];

      public function department()
    {
        return $this->belongsTo(
            Department::class,
            'department_id'
        );
    }

}
