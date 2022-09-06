@extends('layouts.admin.master')
@section('title','Service Category Create') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Service Category Add</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Add Service Category</li>
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
                <h4 class="card-title">Add Service Category</h4>
                <p class="card-title-desc">Create Service Category here....!</p>
                <form action="{{route('service_category.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Service Category Title<sup>*</sup></label>
                                <input class="form-control" name="title"  type="text" placeholder="Enter title" value="{{old('title')}}" required>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Service<sup>*</sup></label>
                                <select name="service_id" class="form-control" required>
                                    <option >Select Service</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}">{{$service->title}}</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>File<sup>*</sup></label>
                                <input type="file" name="file" class="form-control">
                                @error('file')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Order By<sup>*</sup></label>
                                <input class="form-control" name="order_by"  type="text" placeholder="Enter order by" value="{{old('order_by')}}" required>
                                @error('order_by')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label>Details</label>
                                <textarea name="body" class="form-control" id="service_body">{{old('body')}}</textarea>
                                @error('body')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
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
@endsection

@section('custome-js')
<!--tinymce js-->
<script src="{{asset('/')}}assets/admin/libs/tinymce/tinymce.min.js"></script>

<!-- Summernote js -->
<script src="{{asset('/')}}assets/admin/libs/summernote/summernote-bs4.min.js"></script>

<!-- init js -->
<script src="{{asset('/')}}assets/admin/js/pages/form-editor.init.js"></script>
<!-- end row -->
@endsection
