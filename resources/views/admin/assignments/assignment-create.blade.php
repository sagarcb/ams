@extends('admin.layouts.master')
@section('title','Create Assignment')
@section('parentPageTitle','Assignments')
@section('currentPageTitle','Create Assignment')
@section('stylesheet')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-8 mr-auto ml-auto">
            <div class="card card-primary">
                <!-- form start -->
                <form role="form" action="{{route('assignment.store')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="float-right"><a href="{{route('assignment.list')}}"><i class="fa fa-list"></i></a></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-5">
                                    <label>Select Course</label>
                                    <select name="course_id" class="form-control">
                                        <option value="">------------</option>
                                        @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->course_code}}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    <span class="text-red" role="alert">
                                        <strong>Course ID field is required!</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="title">Assignment Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Assignment Title.." value="{{old('title')}}">
                                    @error('title')
                                    <span class="text-red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="full_mark">Full Mark</label>
                                    <input type="number" class="form-control" id="full_mark" name="full_mark" placeholder="Assignment Full Mark." value="{{old('full_mark')}}">
                                    @error('full_mark')
                                    <span class="text-red" role="alert">
                                        <strong>Full mark field is required!</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="open_date">Open Date</label>
                                    <input type="date" class="form-control" id="open_date" name="open_date" placeholder="Assignment Open Date." value="{{old('open_date')}}">
                                    @error('open_date')
                                    <span class="text-red" role="alert">
                                        <strong>Open date cannot be empty!</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="end_date">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Assignment Full Mark." value="{{old('end_date')}}">
                                    @error('end_date')
                                    <span class="text-red" role="alert">
                                        <strong>End date cannot be empty!</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
