@extends('layouts.admin.master')
@section('title','Service Edit') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Service Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Edit Service</li>
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
                <h4 class="card-title">Edit Service</h4>
                <p class="card-title-desc">Edit Service here....!</p>
                <form action="{{route('service.update',$service->id)}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Title</label>
                                <input class="form-control" name="title"  type="text" value="{{old('title',$service->title)}}" required>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Order By</label>
                                <input class="form-control" name="order_by" type="number" value="{{old('order_by',$service->order_by)}}"  min="1" required>
                                @error('order_by')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                                @error('order_by')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div style="width:300px;height: 300px;">
                                @if(isset($service->image))
                                <img src="{{asset('assets/admin/images/service/')}}/{{$service->image}}" alt="service image" width="100%">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" {{($service->status == 1)?"selected":""}}>Published</option>
                                    <option value="0" {{($service->status == 0)?"selected":""}}>Un-Published</option>
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