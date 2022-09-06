@extends('layouts.admin.master')
@section('title', 'Result Details')
@section('custome-css')
    <style>
        .dataTables_length {
            position: absolute;
            margin-top: 5px;
        }

        .subject {
            border: 1px solid gainsboro;
            padding: 4px;
            margin-top: 2px;
            border-radius: 4px;
        }
    </style>
    <!-- DataTables -->
    <link href="{{ asset('/') }}assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
        rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('/') }}assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
        rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Result Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Admin Section</li>/
                        <a href="{{ route('get.result') }}">Back</a>
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
                        <h4 class="col-md-10">Result Details</h4>
                        <a href="{{ route('get.result') }}" class="btn btn-primary btn-sm col-md-2"><i
                                class="fa fa-arrow-left"></i> Change Exam</a>
                    </div>
                    <br>
                    @include('_message')
                    @foreach ($details as $key => $item)
                        <div class="subject">
                            <label for="" class="form-control" style="background: gainsboro;">
                                {{ $item['name'] }} </label>
                            <table class="kt-table-result table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Class Roll</th>
                                        <th>Name</th>
                                        <th>Section</th>
                                        <th>Total</th>
                                        <th>CQ</th>
                                        <th>MCQ</th>
                                        <th>Practical</th>
                                        <th>GPA</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($item['result'] as $key => $value)
                                        <tr>
                                            <td>{{ $value->student->class_roll }}</td>
                                            <td>{{ $value->student->full_name }}</td>
                                            <td>{{ $value->marksetup->section->name }}</td>
                                            <td>{{ $value->total_mark }}</td>
                                            <td>{{ $value->cq }}</td>
                                            <td>{{ $value->mcq }}</td>
                                            <td>{{ $value->practical }}</td>
                                            <td>{{ number_format($value->gpa, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    @endforeach
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
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}assets/admin/libs/jszip/jszip.min.js"></script>
    <script src="{{ asset('/') }}assets/admin/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('/') }}assets/admin/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
    </script>

    <!-- Datatable init js -->
    <script src="{{ asset('/') }}assets/admin/js/pages/datatables.init.js"></script>
@endsection
