@extends('admin.layouts.master')
@section('title','Student Marking')
@section('parentPageTitle','Assignments')
@section('currentPageTitle','Student Marking')
@section('stylesheet')
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{''}}/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{''}}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Assignment Title: </h3>
                    <h3>Full Mark: <span id="fullMark"></span></h3>
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
                                    <input type="number" class=" form-control marking" placeholder="Marking">
                                </td>
                                <td>
                                    <input type="text" class="form-control comment" placeholder="Comments">
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary saveBtn">Save / Update</button>
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
    <script>
        $(function () {
            $("#studentMarking").DataTable();
        });
    </script>
@endsection
