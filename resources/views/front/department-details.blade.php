@extends('layouts.front.master')
@section('title', 'Department Details Page')
@section('custome-css')
@endsection
@section('content')
    <div class="container">
        <div class="row" style="padding: 5px">
            <div class="col-md-9">
                <div class="title department-title" style="margin-top: -17px">
                    <h3>Department of {{ $department->title }}</h3>
                </div>
                <hr>
                <div class="details">
                    <h4><u>About {{ $department->title }} Department</u></h4>
                    <p>{!! $department->body !!} </p>
                </div>
                <div class="file">
                    @if (isset($department->image))
                        <img src="{{ asset('assets/admin/images/department/') }}/{{ $department->image }}"
                            alt="department image" width="100%">
                    @endif
                    <p class="text-center">Cumilla Government College</p>
                </div>
                <div class="title">
                    <h3>FACULTY MEMBERS (DEPARTMENT OF ECONOMICS)</h3>
                </div><br>
                <div class="row">
                    @foreach ($department->teachers as $value)
                        <div class="col-md-4 col-sm-4">
                            <div class="department-team">
                                <div class="team-image">
                                    @if ($value->teacher->image)
                                        <img src="{{ asset('/') }}assets/admin/images/employee/{{ $value->teacher->image }}"
                                            class="img-responsive" alt="" style="height: 220px">
                                    @else
                                        <img src="{{ asset('/') }}assets/front/images/demo-profile.jpg"
                                            class="img-responsive" alt="" style="height: 220px">
                                    @endif
                                </div>
                                <div class="team-info">
                                    <h3>{{ $value->teacher->name }}</h3>
                                    <span>{{ $value->teacher->designation->title }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="notice-section">
                    <div class="card">
                        <div class="card-header">
                            <h3>Notices</h3>
                        </div>
                        <hr>
                        <div class="card-body">
                            <ul>
                                @foreach ($notices as $value)
                                    <li><i class="text-green fa fa-caret-right"></i> <a
                                        href="{{ route('notice.details', $value->id) }}">{{$value->title}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card_footer">
                            {{ $notices->links() }}
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="principale_topbar ">
                    <div class="item">
                        <div class="item-header">
                            <div class="item-header-logo">
                                <h4>Departments List</h4>
                            </div>
                        </div>
                        <ul class="important_link_ul">
                            @foreach($departments as $department)
                            <li><a href="{{ route('department.details', $department->id) }}"><i class="text-green fa fa-caret-right"></i>  {{$department->title}}</a></li>
                            <hr>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
