<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['course_id','title','full_mark','open_date','end_date'];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }

    public function assignment_submissions()
    {
        return $this->hasMany(AssignmentSubmission::class,'assignment_id','id');
    }
}
