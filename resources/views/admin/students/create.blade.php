@extends('layouts.admin.master')
@section('title', 'Student Create')
@section('custome-css')
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Student Add</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Add Student</li>
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
                    <h4 class="card-title">Add Student</h4>
                    <p class="card-title-desc">Create Student here....!</p>
                    @include('_message')
                    <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Full Name<sup>*</sup></label>
                                    <input class="form-control" name="full_name" type="text"
                                        placeholder="Enter name full name" value="{{ old('full_name') }}" required>
                                    @error('full_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>SSC ROLL<sup>*</sup></label>
                                    <input class="form-control" name="ssc_roll" type="text"
                                        placeholder="Enter name ssc roll" value="{{ old('ssc_roll') }}" required>
                                    @error('ssc_roll')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>SSC Board<sup>*</sup></label>
                                    <input class="form-control" name="ssc_board" type="text"
                                        placeholder="Enter name ssc board" value="{{ old('ssc_board') }}" required>
                                    @error('ssc_board')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Education Year<sup>*</sup></label>
                                    <input class="form-control" name="education_year" type="text"
                                        value="{{ date('Y') }}" readonly>
                                    @error('education_year')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Section<sup>*</sup></label>
                                    <select name="section_id" class="form-control" required>
                                        <option value="">Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="">Certificate</label>
                                    <select name="certificate_id" id="" class="form-control" required>
                                        @foreach ($certificates as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('certificate_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Gender<sup>*</sup></label>
                                <select name="gender" required="" class="form-control">
                                    <option value="M" >Male</option>
                                    <option value="F">Female</option>
                                </select>
                                <p class="text-danger-error" id="gender_error"></p>
                                @error('gender')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <!-- end row -->
@endsection
