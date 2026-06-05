<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
  protected $guarded = [];

   public function department()
    {
        return $this->belongsTo(
            Department::class,
            'department_id'
        );
    }

    public function subject()
    {
        return $this->belongsTo(
            SubjectDepartment::class,
            'subject_department_id'
        );
    }
}
