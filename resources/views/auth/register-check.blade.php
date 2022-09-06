@extends('layouts.front.master')
@section('title', 'Registration Form')
@section('custome-css')
@endsection
@section('content')
    <!-- MultiStep Form -->
    <div class="container">
        @include('_message')
        <div id="grad1" style="    padding: 15px 30%;">
            <div class="row justify-content-center mt-0">
                <div class="col-md-12 p-0 mt-3 mb-2">
                    <div class="card main-card">
                        <h2><strong>Online Registration Form</strong></h2>
                        <p>Fill all form field to go to next step</p>
                        <div class="row" style="padding: 10px">
                            <div class="col-md-11 mx-0">
                                <form action="{{route('check.register.student')}}" method="GET" id="msform">
                                    @csrf
                                    @method('GET')
                                    <input type="number" name="ssc_roll" placeholder="Enter SSC Roll" required style="margin-bottom: 25px;">
                                    <select name="section_id" id="" class="" required>
                                        <option value="">Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <button class="btn btn-info" type="submit">Next</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
