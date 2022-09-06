@extends('layouts.admin.master')
@section('title','Notice Edit') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Notice Update</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Add notice</li>
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
                <h4 class="card-title">Update notice</h4>
                <p class="card-title-desc">Update notice here....!</p>
                <form action="{{route('notice.update',$notice->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Notice Title<sup>*</sup></label>
                                <input class="form-control" name="title"  type="text" placeholder="Enter title" value="{{old('title',$notice->title)}}" required>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Notice By<sup></sup></label>
                                <input name="notice_by" class="form-control" name="text" value="Honorable Principale" type="text" readonly>
                                @error('notice_by')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Published Date<sup></sup></label>
                                <input class="form-control" name="published_date"  type="date" placeholder="published date" value="{{old('published_date',$notice->published_date)}}" required>
                                @error('published_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Department<sup>*</sup></label>
                                <select name="department_id" class="form-control" required>
                                    <option value="0" {{($notice->designation_id == 0)?"selected":""}} >Central</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}" {{($department->id == $notice->department_id)?"selected":""}} >{{$department->title}}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Details</label>
                                <textarea name="details" class="form-control">{{old('details',$notice->details)}}</textarea>
                                @error('details')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>File</label>
                                <input type="file" name="file" class="form-control">
                                @error('file')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                @if(isset($notice->file))
                                    @if($notice->is_pdf == 1)
                                    <div>
                                        <object data="{{asset('assets/admin/images/notice/pdf')}}/{{$notice->file}}" type="application/pdf" width="300" height="200">
                                            <a href="{{asset('assets/admin/images/notice/pdf')}}/{{$notice->file}}">View</a>
                                        </object>
                                    </div>
                                    @else
                                        <img src="{{asset('assets/admin/images/notice/images')}}/{{$notice->file}}" alt="notice image" width="100%">
                                    @endif
                                @endif
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