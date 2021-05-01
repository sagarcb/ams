@extends('admin.layouts.master')
@section('title','Course Students')
@section('parentPageTitle','Home')
@section('currentPageTitle','Course Code: '.$course->course_code)
@section('stylesheet')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{''}}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

    {{--Toast notification Library--}}
    <link rel="stylesheet" href="{{asset('toast-notification/js-snackbar.css')}}">
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add student</h4>
                </div>

                <div class="card-body">
                    <form action="">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" id="student_name" class="form-control" placeholder="Student Name">
                            </div>
                            <div class="col">
                                <input type="text" id="student_id" class="form-control" placeholder="Student ID">
                                <input type="text" id="course_id" value="{{$course->id}}" hidden>
                                <input type="text" id="course_code" value="{{$course->course_code}}" hidden>
                                <input type="text" id="courseStudentId" value="" hidden>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary" id="saveBtn">Save/Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Student name</th>
                            <th>Student ID</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                        <tr data-id="{{$student->id}}">
                            <td class="courseCode">{{$course->course_code}}</td>
                            <td class="studentName">{{$student->student_name}}</td>
                            <td class="studentId">{{$student->student_id}}</td>
                            <td>
                                <button data-id="{{$student->id}}" class="btn btn-warning btn-sm editBtn" data-toggle="tool-tip" title="Edit Student">
                                    <i class="fa fa-edit"></i></button>
                                <button data-id="{{$student->id}}" class="btn btn-danger btn-sm deleteBtn" data-toggle="tool-tip" title="Delete Student">
                                    <i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Course Code</th>
                            <th>Student name</th>
                            <th>Student ID</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{''}}/plugins/datatables/jquery.dataTables.js"></script>
    <script src="{{''}}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{''}}/dist/js/demo.js"></script>
    {{--Toast Notification Library--}}
    <script src="{{asset('toast-notification/js-snackbar.js')}}"></script>
    <script src="{{asset('js/add-courseStudents.js')}}"></script>
    <script>
        $(function () {
            $("#example2").DataTable();
        });
    </script>
@endsection
