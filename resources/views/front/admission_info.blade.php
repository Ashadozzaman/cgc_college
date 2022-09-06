@extends('layouts.front.master')
@section('title', 'Admission Information')
@section('custome-css')
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
    <div class="container">
        <div class="row">
            <div class="col-md-9" style="margin-top: -18px;">
                <div class="title">
                    <h3>{{$title}} <small>(Cumilla Govt. College)</small></h3>
                </div><br>
                <div class="row">
                    <div class="file-details-class">

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>title</th>
                                    <th width="20%">Details</th>
                                    <th>Published Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($infos as $key => $information)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ Str::limit($information->title, 30, '...') }}</td>
                                        <td>{{ Str::limit($information->details, 30, '...') }}</td>
                                        <td>{{ $information->published_date }}</td>
                                        <td>
                                            <a href="{{route('details.information',['slag'=>$slag,'id'=>$information->id])}}" class="btn btn-primary btn-sm">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-md-3" style="padding: 0;">
                @include('front._mini_right_sidebar')
            </div>
        </div>
    </div>
@endsection
@section('custome-js')

    <!-- Required datatable js -->
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
    </script>

    <!-- Datatable init js -->
    <script src="{{ asset('/') }}assets/admin/js/pages/datatables.init.js"></script>
@endsection
