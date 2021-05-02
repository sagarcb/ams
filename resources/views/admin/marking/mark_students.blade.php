@extends('admin.layouts.master')
@section('title','Student Marking')
@section('parentPageTitle','Assignments')
@section('currentPageTitle','Student Marking')
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
                    <h4>Assignment Title: {{$assignment->title}}  <span class="float-right">Start Date: {{date('d-M-Y',strtotime($assignment->open_date))}}</span></h4>
                    <h4>Full Mark:<span id="fullMark">{{$assignment->full_mark}}</span>
                        <span class="float-right"> End Date: {{date('d-M-Y',strtotime($assignment->end_date))}}</span>
                    </h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="studentMarking" class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Student Id</th>
                            <th>Mark</th>
                            <th>Comment</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $row)
                            <tr data-id="{{$assignment->id}}">
                                <td>{{$row->student_id}}</td>
                                <td>

                                    <input type="number" name="mark" class="form-control marking" placeholder="Marking"
                                           value="{{$row->mark}}" {{($row->submission_status == 1) ? 'readonly' : '' }}>
                                    <input type="text" name="assignment_id" class="assignment_id" value="{{$assignment->id}}" hidden>
                                    <input type="text" name="course_student_id" class="course_student_id" value="{{$row->id}}" hidden>
                                </td>
                                <td>
                                    <input type="text" name="comment" class="form-control comment" placeholder="Comments"
                                           value="{{$row->comment}}" {{$row->submission_status == 1 ? 'readonly' : '' }}>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary saveBtn">Save</button>
                                    <button class="btn btn-sm btn-warning editBtn">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Student Id</th>
                            <th>Mark</th>
                            <th>Comment</th>
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
    {{--Toast Notification script--}}
    <script src="{{asset('toast-notification/js-snackbar.js')}}"></script>
    <script src="{{asset('js/student-marking.js')}}"></script>
    <script>
        $(function () {
            $("#studentMarking").DataTable();
        });
    </script>

@endsection
