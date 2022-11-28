@extends('layouts.admin.master')
@section('title', 'Result Details')
@section('custome-css')
    <style>
        .dataTables_length {
            position: absolute;
            margin-top: 5px;
        }
        th{
        }
        tr,td,th{
            padding: 2px !important;
            text-align: center;
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
                        <h4 class="col-md-10">Main Subject Wise Result Details</h4>
                        <a href="{{ route('get.result') }}" class="btn btn-primary btn-sm col-md-2"><i
                                class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <br>
                    @include('_message')
                    <div class="subject">
                        <table class="kt-table-result- table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:13px;">
                            <thead>
                                <tr>
                                    <th>Roll</th>
                                    @foreach ($mainSubjects as $item)
                                        <th title="{{$item['mainSub']}}">{{strtoupper(substr($item['mainSub'], 0, 3))}}</th>
                                    @endforeach
                                    <th>GPA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subject_result_details as $srd => $item)
                                <tr>
                                    <td>{{$item['class_roll']}}</td>
                                    @foreach ($item['results'] as $value)
                                    @php
                                        if ($value['gpa'] === "F"){
                                            $background = "red";
                                            $color = "white";
                                        }elseif($value['mainSub_status'] == '4th'){
                                            $background = "lightgray";
                                        }else{
                                            $background = "";
                                            $color = "";
                                        }
                                    @endphp
                                        <td style="text-align:center; background: {{ $background}};color:{{$color }}">
                                            {{($value['gpa'] == "F")?$value['gpa']:number_format($value['gpa'], 2)}}
                                            <table style="width: 100%">
                                                <tr>
                                                    <td>10</td>
                                                    <td>10</td>
                                                    <td>10</td>
                                                </tr>
                                            </table>
                                        </td>
                                    @endforeach
                                    <td>{{ ($item['total_gpa'] == 'F')?"F":number_format($item['total_gpa'],2)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
