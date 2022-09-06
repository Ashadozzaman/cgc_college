@extends('layouts.admin.master')
@section('title','Result Edit') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Result Update</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Add Result</li>
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
                <h4 class="card-title">Update Result</h4>
                <p class="card-title-desc">Update Result here....!</p>
                <form action="{{route('result.update',$result->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Result Title<sup>*</sup></label>
                                <input class="form-control" name="title"  type="text" placeholder="Enter title" value="{{old('title',$result->title)}}" required>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Result Type<sup>*</sup></label>
                                <select name="result_type" class="form-control"  required>
                                    <option value="1"  {{($result->result_type == 1)?"selected":""}}>Internal</option>
                                    <option value="2"  {{($result->result_type == 2)?"selected":""}}>Public</option>
                                </select>
                                @error('result_type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Published Date<sup></sup></label>
                                <input class="form-control" name="published_date"  type="date" placeholder="published date" value="{{old('published_date',$result->published_date)}}" required>
                                @error('published_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Details</label>
                                <textarea name="details" class="form-control">{{old('details',$result->details)}}</textarea>
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
                                @if(isset($result->file))
                                    @if($result->is_pdf == 1)
                                    <div>
                                        <object data="{{asset('assets/admin/images/result/pdf')}}/{{$result->file}}" type="application/pdf" width="300" height="200">
                                            <a href="{{asset('assets/admin/images/result/pdf')}}/{{$result->file}}">View</a>
                                        </object>
                                    </div>
                                    @else
                                        <img src="{{asset('assets/admin/images/result/images')}}/{{$result->file}}" alt="result image" width="40%">
                                    @endif
                                @endif
                            </div>
                            <br>
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