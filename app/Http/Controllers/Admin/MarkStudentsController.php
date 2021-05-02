<?php

namespace App\Http\Controllers\Admin;

use App\Assignment;
use App\AssignmentSubmission;
use App\Course;
use App\CourseStudent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Assign;

class MarkStudentsController extends Controller
{
    public function index($assignmentId)
    {
        $assignment = Assignment::find($assignmentId);

        /*$students = Assignment::join('courses','courses.id','=','assignments.course_id')
                    ->rightJoin('course_students','course_students.course_id','=','courses.id')
                    ->leftJoin('assignment_submissions',
                        'assignment_submissions.course_student_id','=','course_students.id')->get();*/
        $students = Course::join('course_students','course_students.course_id','courses.id')
            ->leftJoin('assignment_submissions','assignment_submissions.course_student_id','=','course_students.id')
            ->select('course_students.id','course_students.student_id','assignment_submissions.submission_status',
                'assignment_submissions.mark','assignment_submissions.comment')->get();
        return view('admin.marking.mark_students',compact('students','assignment'));
    }

    public function storeMarking(Request $request)
    {
        $request->validate([
           'course_student_id' => 'required',
           'assignment_id' => 'required',
           'mark' => 'required',
        ]);

        AssignmentSubmission::updateOrInsert(
          ['course_student_id' => $request->course_student_id,'assignment_id' => $request->assignment_id],
          [
              'course_student_id' => $request->course_student_id,
              'assignment_id' => $request->assignment_id,
              'mark' => $request->mark,
              'comment' => $request->comment,
              'submission_status' => 1
          ]
        );
        $data = $request;
        return response()->json('Data added successfully',200);
    }
}
