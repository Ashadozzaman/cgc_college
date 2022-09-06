@extends('layouts.front.master')
@section('title', 'Notice Details Page')
@section('custome-css')
@endsection
@section('content')
    <div class="container">
        <div class="row" style="padding: 20px;margin-top: -34px;">
            <div class="title">
                <h3>{{ $notice->title }}</h3>
                <hr>
                <span><b>Published Date: {{ $notice->published_date }}</b></span>
            </div>
            <hr>
            <div class="file">
                @if (isset($notice->file))
                    @if ($notice->is_pdf == 1)
                        <div>
                            <object data="{{ asset('assets/admin/images/notice/pdf') }}/{{ $notice->file }}"
                                type="application/pdf" width="100%" height="800">

                            </object>
                        </div>
                    @else
                        <img src="{{ asset('assets/admin/images/notice/images') }}/{{ $notice->file }}" alt="notice image"
                            width="100%">
                    @endif
                @endif
            </div>
            <div class="details">
                <p>{!! $notice->details !!} </p>
            </div>
            <div class="view">
                @if (isset($notice->file))
                    @if ($notice->is_pdf == 1)
                        <a class="btn btn-primary" target="_blank"
                            href="{{ asset('assets/admin/images/notice/pdf') }}/{{ $notice->file }}">View</a>
                    @else
                        <a class="btn btn-primary" target="_blank"
                            href="{{ asset('assets/admin/images/notice/images') }}/{{ $notice->file }}">View</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
