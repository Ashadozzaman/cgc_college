@extends('layouts.front.master')
@section('title', 'About Us Page')
@section('custome-css')
@endsection
@section('content')
    <div class="container">
        <div class="row" style="padding: 0px 20px">
            <div class="title">
                <h3>About Us</h3>
            </div>
            <div class="">
                <p>{!! $about->description !!} </p>
            </div>
        </div>
    </div>
@endsection
