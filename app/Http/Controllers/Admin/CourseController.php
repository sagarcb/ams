<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\CourseStudent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.my_courses.course-list',compact('courses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'title' => 'required',
           'course_code' => 'required',
        ]);

        $course = Course::create([
            'title' => $request->title,
            'course_code' => $request->course_code,
            'user_id' => Auth::id()
        ]);
        return response()->json($course,200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'title' => 'required',
           'course_code' => 'required'
        ]);

        $data = Course::find($id);
        $data->title = $request->title;
        $data->course_code = $request->course_code;
        $data->save();
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        Course::find($id)->assignments()->delete();
        Course::find($id)->delete();
        return response()->json('Data Successfully Deleted');
    }

    public function addStudent($courseId)
    {
        $course = Course::where('id',$courseId)->first();
        $students = CourseStudent::where('course_id',$courseId)->latest()->get();
        return view('admin.my_courses.course-students-add',compact('course','students'));
    }

    public function storeStudent(Request $request)
    {
        $this->validate($request,[
           'course_id' => 'required',
           'student_name' => 'required',
           'student_id' => 'required|unique:course_students,student_id,'.$request->id
        ]);

        //$data = CourseStudent::create($request->all());
        CourseStudent::updateOrInsert(
            ['id' => $request->id],
            ['course_id'=>$request->course_id,'student_name' => $request->student_name,'student_id' => $request->student_id]
        );
        $data = $request;
        return response()->json($data, 200);
    }

    public function deleteStudent($id)
    {
        CourseStudent::find($id)->assignment_submissions()->delete();
        CourseStudent::find($id)->delete();
        return response()->json('Successfully Deleted',200);
    }
}
