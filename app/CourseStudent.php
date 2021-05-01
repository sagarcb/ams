<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    protected $fillable = ['course_id','student_name','student_id'];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }

    public function assignment_submissions()
    {
        return $this->hasMany(AssignmentSubmission::class,'course_student_id','id');
    }
}
