@extends('layouts.front.master')
@section('title', 'Home Page')
@section('custome-css')
    <style>
        .dataTables_length {
            position: absolute;
            margin-top: 5px;
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
    <!-- CONTACT -->
    <div class="container">
        <a href="{{route('student.result.print',$student->student_id)}}" class="btn btn-success btn-sm" target="_blank"> <i class="fa fa-print"></i> Print </a>
        <div class="row">
            <div class="col-md-12">
                @foreach ($exam_wises as $item)
                    <h3 class="col-md-12 text-center"> <b>{{ $item['exam'] }}</b></h3>
                    <div class="">
                        <table class="kt-table-result- table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:13px;">
                            <thead>
                                <tr>
                                    @foreach ($item['main_subjects'] as $val)
                                        <th title="{{ $val->name }}">{{ $val->name }}</th>
                                    @endforeach
                                    <th>GPA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($item['main_subjects_result'] as $m_val)
                                        @php
                                            if ($m_val['status'] == '4th') {
                                                $background = 'lightgray';
                                            } else {
                                                $background = '';
                                            }
                                        @endphp
                                        <td style="background: {{ $background }}">
                                            {{ $m_val['result'] == 'F' ? $m_val['result'] : number_format($m_val['result'], 2) }}
                                        </td>
                                    @endforeach
                                    <td>{{ $item['main_total_gpa'] == 'F' ? $item['main_total_gpa'] : number_format($item['main_total_gpa'], 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        <table class=" table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:13px;">
                            <thead>
                                <tr>
                                    @foreach ($item['subjects'] as $val)
                                        <th title="{{ $val->main_subject->name }}">
                                            {{ strtoupper(substr($val->main_subject->name, 0, 3)) }}<br>{{ $val->subject_code }}
                                        </th>
                                    @endforeach
                                    {{-- <th>GPA</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($item['results'] as $result)
                                        <td>{{ $result == 'F' ? $result : number_format($result, 2) }}</td>
                                    @endforeach
                                    {{-- <td>{{($item['total_gpa'] == "F")?$item['total_gpa']:number_format($item['total_gpa'], 2)}}</td> --}}
                                </tr>
                                <tr>
                                    <td colspan="{{ count($item['totalMarks']) }}" class="text-center"><b>Total Mark Each Subjects</b></td>
                                </tr>
                                <tr>
                                    @foreach ($item['totalMarks'] as $mark)
                                        <td>{{ $mark }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    </div>
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
