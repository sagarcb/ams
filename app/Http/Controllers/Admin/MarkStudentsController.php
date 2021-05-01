<?php

namespace App\Http\Controllers\Admin;

use App\CourseStudent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarkStudentsController extends Controller
{
    public function index($course_id)
    {
        $students = CourseStudent::where('course_id',$course_id)->get();
        return view('admin.marking.mark_students',compact('students'));
    }
}
