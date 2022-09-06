@extends('layouts.front.master')
@section('title', 'service Details Page')
@section('custome-css')
@endsection
@section('content')
    <div class="container">
        <div class="row" style="padding: 20px;margin-top: -34px;">
            <div class="title">
                <h3>{{ $service->title }}</h3>
            </div>
            <div class="">
                <p>{!! $service->body !!} </p>
            </div>
            <div class="file">
                @if (isset($service->image))
                    <img src="{{ asset('assets/admin/images/service_category') }}/{{ $service->image }}" alt="service image">
                @endif
            </div>
            <div class="view">
            </div>
        </div>
    </div>
@endsection
