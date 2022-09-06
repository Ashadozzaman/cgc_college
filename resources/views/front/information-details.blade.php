@extends('layouts.front.master')
@section('title', 'College Information')
@section('custome-css')
@endsection
@section('content')
@php
if ($slag == 'public' || $slag == 'internal') {
   $dir = 'result';
}else{
   $dir = $slag;
}
    
@endphp
    <div class="container">
        <div class="row" style="padding: 20px;margin-top:-25px;">
            {{-- <h2>{{$title}} <small>(Cumilla Govt. College)</small></h2> --}}
            <div class="title">
                <h3>{{ $infos->title }} <small>({{$title}})</small></h3>
                <hr>
                <span><b>Published Date: {{ $infos->published_date }}</b></span>
            </div>
            <hr>
            <div class="file">
                @if (isset($infos->file))
                    @if ($infos->is_pdf == 1)
                        <div>
                            <object data="{{ asset('assets/admin/images/'.$dir.'/pdf') }}/{{ $infos->file }}"
                                type="application/pdf" width="100%" height="800">

                            </object>
                        </div>
                    @else
                        <img src="{{ asset('assets/admin/images/'.$dir.'/images') }}/{{ $infos->file }}" alt="notice image"
                            width="100%">
                    @endif
                @endif
            </div>
            <hr>
            <div class="details">
                <p>{!! $infos->details !!} </p>
            </div>
            <div class="view">
                <a class="btn btn-info" href="{{route('information',$slag)}}"><i class="fa fa-arrow-left"></i> Back</a>
                @if (isset($infos->file))
                    @if ($infos->is_pdf == 1)
                        <a class="btn btn-primary" target="_blank"
                            href="{{ asset('assets/admin/images/'.$dir.'/pdf') }}/{{ $infos->file }}">Details</a>
                    @else
                        <a class="btn btn-primary" target="_blank"
                            href="{{ asset('assets/admin/images/'.$dir.'/images') }}/{{ $infos->file }}">Details</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
