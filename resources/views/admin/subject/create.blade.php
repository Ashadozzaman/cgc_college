@extends('layouts.admin.master')
@section('title', 'Subject Create')
@section('custome-css')
<style>
    
.mark-check{
  float: left;
  margin-right: 35px;
}
</style>
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Subject Add</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Add Subject</li>
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
                    <h4 class="card-title">Add Subject</h4>
                    <p class="card-title-desc">Create Subject here....!</p>
                    <form action="{{ route('subject.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Name</label>
                                    <input class="form-control" name="name" type="text" placeholder="Enter name"
                                        required>
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
                                            <option value="{{ $main_subject->id }}">{{ $main_subject->name }}</option>
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
                                    <input class="form-control" name="subject_code" type="number"
                                        placeholder="Enter number" required>
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
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('certificate_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Sections</label>
                                    <select name="section_id" class="form-control" required>
                                        <option>Select section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Subject Status</label>
                                    <select name="subject_status" class="form-control" required>
                                        <option value="Compulsory">Compulsory</option>
                                        <option value="Elective">Elective</option>
                                        <option value="4th">4th</option>
                                    </select>
                                    @error('subject_status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Order By</label>
                                    <input class="form-control" name="order_by" type="number"
                                        placeholder="Enter Order Number" min="1" required>
                                    @error('order_by')
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
    <!-- end row -->
@endsection
@section('custome-css')
<script>
    
</script>
@endsection