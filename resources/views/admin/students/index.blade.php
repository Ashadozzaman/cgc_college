@extends('layouts.admin.master')
@section('title','New Students Rolls List') 
@section('custome-css')
<!-- DataTables -->
<link href="{{asset('/')}}assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{asset('/')}}assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">New Students Rolls List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Admin Section</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="user-title row">
                    <h4 class="col-md-8">Add New Students</h4>
                    <a href="{{route('student.create')}}" class="btn btn-primary btn-sm col-md-2"><i class="fa fa-plus"></i>Add New Student Roll</a>
                    <a href="{{route('import.student')}}" class="btn btn-success btn-sm col-md-2"><i class="fa fa-file-excel"></i> Import Student</a>
                </div>
                <br>
                @include('_message')
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Student Id</th>
                            <th>SSC ROLL</th>
                            <th>Full Name</th>
                            <th>Certificate</th>
                            <th>Education Year</th>
                            <th>Section</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    	@foreach($students as $key=>$student)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$student->student_id}}</td>
                            <td>{{$student->ssc_roll}}</td>
                            <td>{{$student->full_name}}</td>
                            <td>{{$student->certificate->name}}</td>
                            <td>{{$student->education_year}}</td>
                            <td>{{$student->section->name}}</td>
                            <td>
                                <div style="display: flex;">
                                    <a href="{{route('student.edit',$student->id)}}" class="fa fa-edit"></a>
                                    <form action="{{route('student.destroy',$student->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Are you sure you want to delete this item?');" class="btn fa fa-trash" style="margin-top: -7px;background: none;"></button>  
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<!-- end row -->
@endsection
@section('custome-js')

    <!-- Required datatable js -->
    <script src="{{asset('/')}}assets/admin/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('/')}}assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="{{asset('/')}}assets/admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('/')}}assets/admin/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{asset('/')}}assets/admin/libs/jszip/jszip.min.js"></script>
    <script src="{{asset('/')}}assets/admin/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{asset('/')}}assets/admin/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{asset('/')}}assets/admin/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('/')}}assets/admin/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('/')}}assets/admin/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="{{asset('/')}}assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('/')}}assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="{{asset('/')}}assets/admin/js/pages/datatables.init.js"></script>
@endsection