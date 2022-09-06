@extends('layouts.admin.master')
@section('title','Important Link Edit') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Important Link Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Edit Important Link</li>
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
                <h4 class="card-title">Edit Important Link</h4>
                <p class="card-title-desc">Edit Important Link here....!</p>
                <form action="{{route('important_link.update',$important_link->id)}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Title</label>
                                <input class="form-control" name="title"  type="text" value="{{old('title',$important_link->title)}}" required>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Link</label>
                                <input class="form-control" name="link"  type="url" value="{{old('link',$important_link->link)}}" required>
                                @error('link')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Order By</label>
                                <input class="form-control" name="order_by" type="number" value="{{old('order_by',$important_link->order_by)}}"  min="1" required>
                                @error('order_by')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" {{($important_link->status == 1)?"selected":""}}>Published</option>
                                    <option value="0" {{($important_link->status == 0)?"selected":""}}>Un-Published</option>
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