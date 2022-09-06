@extends('layouts.admin.master')
@section('title','Teacher Assign') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Teacher Assign update</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to update Teacher Assign</li>
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
                <h4 class="card-title">update Teacher Assign</h4>
                <p class="card-title-desc">Create Teacher Assign here....!</p>
                <form action="{{route('teacher_assign.update',$teacher_assign->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Department<sup>*</sup></label>
                                <select name="department_id" class="form-control" required>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}" {{($department->id == $teacher_assign->id)?"selected":""}}>{{$department->title}}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Teacher<sup>*</sup></label>
                                <select name="teacher_id" class="form-control" required>
                                    @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}" {{($teacher->id == $teacher_assign->id)?"selected":""}}>{{$teacher->name}}</option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-left: 34px">
                            <div class="md-4">
                                <div class="mark-check">
                                    <input name="is_department_head" {{($teacher_assign->is_department_head == 1)?"checked":""}} class="form-check-input" type="checkbox" value="1" id="is_department_head">
                                    <label class="form-check-label" for="is_department_head">
                                        Department Head
                                    </label>
                                </div>
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