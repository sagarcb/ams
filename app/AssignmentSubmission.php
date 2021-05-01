<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    protected $fillable = ['course_student_id','assignment_id','submission_status','mark','comment'];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class,'assignment_id','id');
    }

    public function course_student()
    {
        return $this->belongsTo(CourseStudent::class,'course_student_id','id');
    }
}
