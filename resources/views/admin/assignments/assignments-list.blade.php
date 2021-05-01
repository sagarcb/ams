@extends('admin.layouts.master')
@section('title','Assignments')
@section('parentPageTitle','Home')
@section('currentPageTitle','Assignments')
@section('stylesheet')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('assignment.create')}}">
                        <button type="button" id="addCourseBtn" class="btn btn-primary">Create Assignment</button>
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Assignment Title</th>
                            <th>Course Code</th>
                            <th>Full Mark</th>
                            <th>Open Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($assignments as $assignment)
                            <tr data-id="{{$assignment->id}}">
                                <td class="title">{{$assignment->title}}</td>
                                <td class="course_code">{{$assignment->course->course_code}}</td>
                                <td class="course_code">{{$assignment->full_mark}}</td>
                                <td class="course_code">{{date('d-M-Y',strtotime($assignment->open_date))}}</td>
                                <td class="course_code">{{date('d-M-Y',strtotime($assignment->end_date))}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        <a href="{{route('assignment.edit',$assignment->id)}}" class="m-1" data-toggle="tooltip" title="Edit Assignment">
                                            <button data-id="{{$assignment->id}}" class="btn btn-warning btn-sm editBtn">
                                                <i class="fa fa-edit"></i></button>
                                        </a>
                                        <button data-id="{{$assignment->id}}" class="btn btn-danger btn-sm m-1 deleteBtn " data-toggle="tooltip" title="Delete Assignment">
                                                <i class="fa fa-trash"></i></button>
                                        <a href="{{route('assignment.students',$assignment->course_id)}}" class="m-1">
                                            <button class="btn btn-primary btn-sm" data-toggle="tooltip" title="Start marking students">Marking</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Assignment Title</th>
                            <th>Course id</th>
                            <th>Full Mark</th>
                            <th>Open Date</th>
                            <th>End Date</th>
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
    <script src="{{asset('js/assignment-list.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection
