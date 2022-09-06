@extends('layouts.admin.master')
@section('title','Academic Calendar Edit') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Academic Calendar Update</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Add Academic Calendar</li>
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
                <h4 class="card-title">Update Academic Calendar</h4>
                <p class="card-title-desc">Update Academic Calendar here....!</p>
                <form action="{{route('academic_calendar.update',$academic_calendar->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Academic Calendar Title<sup>*</sup></label>
                                <input class="form-control" name="title"  type="text" placeholder="Enter title" value="{{old('title',$academic_calendar->title)}}" required>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Published Date<sup></sup></label>
                                <input class="form-control" name="published_date"  type="date" placeholder="published date" value="{{old('published_date',$academic_calendar->published_date)}}" required>
                                @error('published_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Details</label>
                                <textarea name="details" class="form-control">{{old('details',$academic_calendar->details)}}</textarea>
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
                                @if(isset($academic_calendar->file))
                                    @if($academic_calendar->is_pdf == 1)
                                    <div>
                                        <object data="{{asset('assets/admin/images/academic_calendar/pdf')}}/{{$academic_calendar->file}}" type="application/pdf" width="300" height="200">
                                            <a href="{{asset('assets/admin/images/academic_calendar/pdf')}}/{{$academic_calendar->file}}">View</a>
                                        </object>
                                    </div>
                                    @else
                                        <img src="{{asset('assets/admin/images/academic_calendar/images')}}/{{$academic_calendar->file}}" alt="academic calendar image" width="100%">
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