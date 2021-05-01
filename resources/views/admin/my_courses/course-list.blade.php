@extends('admin.layouts.master')
@section('title','My Courses')
@section('parentPageTitle','Home')
@section('currentPageTitle','My Course List')
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
                    <button type="button" id="addCourseBtn" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Add New Course</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Course Title</th>
                            <th>Course Code</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $row)
                        <tr data-id="{{$row->id}}">
                            <td class="title">{{$row->title}}</td>
                            <td class="course_code">{{$row->course_code}}</td>
                            <td>
                                <a href="#" data-toggle="tooltip" title="Edit Course">
                                    <button class="btn btn-warning btn-sm editBtn" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button>
                                </a>
                                <a href="#" data-toggle="tooltip" title="Delete Course">
                                    <button class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i></button>
                                </a>
                                <a href="{{route('course.students.add',$row->id)}}">
                                    <button class="btn btn-primary btn-sm">Add Students</button>
                                </a>
                            </td>
                        </tr>
                         @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Course Title</th>
                            <th>Course Code</th>
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
    {{--Add Course Modal--}}
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Course</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <ul id="msg">

                        </ul>
                    </div>
                    <form role="form" id="addForm" action="{{route('course.store')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="title">Course Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter Course Title">
                            </div>
                            <div class="form-group">
                                <label for="courseCode">Course Code</label>
                                <input type="text" name="course_code" class="form-control" id="courseCode" placeholder="Enter Course Code">
                            </div>
                        <button id="addCourseBtn" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="closeBtn"  type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{--Edit Course Modal--}}
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Course</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="msgEdit" class="col-12">

                    </div>
                    <form id="editForm" role="form" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">Course Title</label>
                            <input type="text" name="title" class="form-control" id="editTitle">
                        </div>
                        <div class="form-group">
                            <label for="courseCode">Course Code</label>
                            <input type="text" name="course_code" class="form-control" id="editCourseCode">
                        </div>
                        <input id="courseId" name="id" type="text" value="" hidden>
                        <button id="updateBtn" type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="closeBtnEdit"  type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{''}}/plugins/datatables/jquery.dataTables.js"></script>
    <script src="{{''}}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{''}}/dist/js/demo.js"></script>
    <script src="{{asset('js/add-course.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection
