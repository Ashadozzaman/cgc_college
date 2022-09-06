@extends('layouts.front.master')
@section('title', 'Faculty List Page')
@section('custome-css')
@endsection
@section('content')
    <div class="container">
        <div class="row" style="padding: 20px 0 0 7px;">
            <div class="col-md-9"  style="margin-top: -18px;">
                <div class="title">
                    <h3>FACULTY MEMBERS <small>(Cumilla Govt. College)</small></h3>
                </div><br>
                <div class="row">
                    @foreach ($teachers as $value)
                        <div class="col-md-4 col-sm-4">
                            <div class="department-team">
                                <div class="team-image">
                                    @if ($value->image)
                                        <img src="{{ asset('/') }}assets/admin/images/employee/{{ $value->image }}"
                                            class="img-responsive" alt="" style="height: 220px">
                                    @else
                                        <img src="{{ asset('/') }}assets/front/images/demo-profile.jpg"
                                            class="img-responsive" alt="" style="height: 220px">
                                    @endif
                                </div>
                                <div class="team-info">
                                    <h3>{{ $value->name }}</h3>
                                    <span>{{ $value->designation->title }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            @include('front._right_sidebar')
        </div>
    </div>
@endsection
