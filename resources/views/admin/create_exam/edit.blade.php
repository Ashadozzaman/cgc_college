@extends('layouts.admin.master')
@section('title','Exam Edit') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Exam Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Edit Exam</li>
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
                <h4 class="card-title">Edit Exam</h4>
                <p class="card-title-desc">Edit Exam here....!</p>
                <form action="{{route('create_exam.update',$create_exam->id)}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Title</label>
                                <input class="form-control" name="title"  type="text" value="{{old('title',$create_exam->title)}}" required>
                                @error('title')
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
                                <label>Session</label>
                                <select name="session" id="" class="form-control" required>
                                    <option value="">Select Session</option>
                                    @for ($i = (date('Y')-4); $i < date('Y') + 2; $i++)
                                        <option value="{{$i}}" {{($create_exam->session == $i)?'selected':'';}}>{{$i -1}}-{{$i}}</option>
                                    @endfor
                                </select>
                                @error('session')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" {{($create_exam->status == 1)?"selected":""}}>Published</option>
                                    <option value="0" {{($create_exam->status == 0)?"selected":""}}>Un-Published</option>
                                </select>
                                @error('status')
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