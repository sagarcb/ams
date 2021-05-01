<?php

namespace App\Http\Controllers\Admin;

use App\Assignment;
use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\CommonMark\Extension\TableOfContents\Normalizer\AsIsNormalizerStrategy;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::all();
        return view('admin.assignments.assignments-list',compact('assignments'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.assignments.assignment-create',compact('courses'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'course_id' => 'required',
            'title' => 'required',
            'full_mark'=> 'required',
            'open_date' => 'required',
            'end_date' => 'required'
        ]);

        Assignment::create($request->all());
        return redirect()->route('assignment.list');
    }

    public function edit($id)
    {
        $assignment = Assignment::find($id);
        $courses = Course::all();
        return view('admin.assignments.assignment-edit',compact('assignment','courses'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'course_id' => 'required',
            'title' => 'required',
            'full_mark'=> 'required',
            'open_date' => 'required',
            'end_date' => 'required'
        ]);

        Assignment::find($id)->update($request->all());
        return redirect()->route('assignment.list');
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();
        return response()->json('Data Successfully Deleted',200);
    }
}
