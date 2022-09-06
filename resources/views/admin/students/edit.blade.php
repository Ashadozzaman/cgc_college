@extends('layouts.admin.master')
@section('title','Student Edit') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Student Update</h4>

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
                <h4 class="card-title">Update Student</h4>
                <p class="card-title-desc">Update Student here....!</p>
                @include('_message')
                <form action="{{route('student.update',$student->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Full Name<sup>*</sup></label>
                                <input class="form-control" name="full_name" type="text"
                                    placeholder="Enter name full name" value="{{old('full_name',$student->full_name)}}" required>
                                @error('full_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>SSC Roll<sup>*</sup></label>
                                <input class="form-control" name="ssc_roll"  type="text" placeholder="Enter ssc roll" value="{{old('ssc_roll',$student->ssc_roll)}}" required>
                                @error('ssc_roll')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>SSC Board<sup>*</sup></label>
                                <input class="form-control" name="ssc_board" type="text"
                                    placeholder="Enter name ssc board" value="{{old('ssc_board',$student->ssc_board)}}" required>
                                @error('ssc_board')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Section<sup>*</sup></label>
                                <select name="section_id" class="form-control" required>
                                    <option>Select section</option>
                                    @foreach($sections as $section)
                                        <option value="{{$section->id}}" {{($section->id == $student->section_id)?"selected":""}} >{{$section->name}}</option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Education Year<sup>*</sup></label>
                                <input class="form-control" name="education_year" type="text"
                                    value="{{ $student->education_year }}" readonly>
                                @error('education_year')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="">Certificate</label>
                                <select name="certificate_id" id="" class="form-control" required>
                                    @foreach ($certificates as $item)
                                        <option value="{{$item->id}}"
                                            {{ $item->id == $student->certificate_id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
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
                                <option value="M" {{$student->gender == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="F" {{$student->gender == 'F' ? 'selected' : '' }}>Female</option>
                            </select>
                            <p class="text-danger-error" id="gender_error"></p>
                            @error('gender')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<!-- end row -->
@endsection