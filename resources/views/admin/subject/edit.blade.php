@extends('layouts.admin.master')
@section('title','Subject Edit') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Subject Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Edit Subject</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Subject</h4>
                <p class="card-title-desc">Edit Subject here....!</p>
                <form action="{{route('subject.update',$subject->id)}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Name</label>
                                <input class="form-control" name="name"  type="text" value="{{old('name',$subject->name)}}" required>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Main Subject</label>
                                <select name="main_subject_id" class="form-control" required>
                                    <option>Select Subject</option>
                                    @foreach ($main_subjects as $main_subject)
                                        <option value="{{ $main_subject->id }}" {{($subject->main_subject_id == $main_subject->id )?"selected":""}}>{{ $main_subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Subject Code</label>
                                <input class="form-control" name="subject_code"  type="number" value="{{old('subject_code',$subject->subject_code)}}" required>
                                @error('subject_code')
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
                                            {{ $item->id == $create_exam->certificate_id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('certificate_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="">Section</label>
                                <select name="section_id" class="form-control" required>
                                    <option value="">Select Section</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}" {{($subject->section_id ==$section->id )?"selected":""}}>{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Subject Status</label>
                                <select class="form-control" name="subject_status">
                                    <option value="Compulsory" {{($subject->subject_status == 'Compulsory')?"selected":""}}>Compulsory</option>
                                    <option value="Elective" {{($subject->subject_status == 'Elective')?"selected":""}}>Elective</option>
                                    <option value="4th" {{($subject->subject_status == '4th')?"selected":""}}>4th</option>
                                </select>
                                @error('subject_status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Order By</label>
                                <input class="form-control" name="order_by" type="number" value="{{old('order_by',$subject->order_by)}}"  min="1" required>
                                @error('order_by')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
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