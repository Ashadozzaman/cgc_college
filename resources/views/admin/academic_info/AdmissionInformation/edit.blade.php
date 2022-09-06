@extends('layouts.admin.master')
@section('title','Admission Information Edit') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Admission Information Update</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Add Admission Information</li>
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
                <h4 class="card-title">Update Admission Information</h4>
                <p class="card-title-desc">Update Admission Information here....!</p>
                <form action="{{route('admission_information.update',$admission_information->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Admission Information Title<sup>*</sup></label>
                                <input class="form-control" name="title"  type="text" placeholder="Enter title" value="{{old('title',$admission_information->title)}}" required>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Published Date<sup></sup></label>
                                <input class="form-control" name="published_date"  type="date" placeholder="published date" value="{{old('published_date',$admission_information->published_date)}}" required>
                                @error('published_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Details</label>
                                <textarea name="details" class="form-control">{{old('details',$admission_information->details)}}</textarea>
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
                                @if(isset($admission_information->file))
                                    @if($admission_information->is_pdf == 1)
                                    <div>
                                        <object data="{{asset('assets/admin/images/admission_information/pdf')}}/{{$admission_information->file}}" type="application/pdf" width="300" height="200">
                                            <a href="{{asset('assets/admin/images/admission_information/pdf')}}/{{$admission_information->file}}">View</a>
                                        </object>
                                    </div>
                                    @else
                                        <img src="{{asset('assets/admin/images/admission_information/images')}}/{{$admission_information->file}}" alt="notice image" width="100%">
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