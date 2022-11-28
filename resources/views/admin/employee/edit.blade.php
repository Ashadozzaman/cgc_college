@extends('layouts.admin.master')
@section('title','Teacher Edit')
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Teacher Update</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Add Teacher</li>
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
                <h4 class="card-title">Update Teacher</h4>
                <p class="card-title-desc">Update Teacher here....!</p>
                <form action="{{route('employee.update',$employee->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Name<sup>*</sup></label>
                                <input class="form-control" name="name"  type="text" placeholder="Enter name" value="{{old('name',$employee->name)}}" required>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Phone<sup>*</sup></label>
                                <input class="form-control" name="phone"  type="text" placeholder="Enter phone number" value="{{old('phone',$employee->phone)}}"  required>
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Address<sup>*</sup></label>
                                <input class="form-control" name="address"  type="text" placeholder="Enter address" value="{{old('address',$employee->address)}}"  required>
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Age<sup>*</sup></label>
                                <input class="form-control" name="age" value="{{old('age',$employee->age)}}"  type="number" placeholder="Enter age" required>
                                @error('age')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Gender<sup>*</sup></label>
                                <select name="gender" class="form-control"  required>
                                    <option value="male" {{($employee->gender == "male")?"selected":""}}>Male</option>
                                    <option value="female" {{($employee->gender == "female")?"selected":""}}>Fe-male</option>
                                </select>
                                @error('gender')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Email<sup></sup></label>
                                <input class="form-control" name="email" value="{{old('email',$employee->email)}}" type="text" placeholder="Enter email">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Joining Date<sup></sup></label>
                                <input class="form-control" name="joining_date"  type="date" placeholder="Joining date" value="{{old('joining_date',$employee->joining_date)}}">
                                @error('joining_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Order By<sup>*</sup></label>
                                <input class="form-control" name="order_by" type="number" placeholder="Enter Order Number" min="1" required value="{{old('order_by',$employee->order_by)}}">
                                @error('order_by')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Designation<sup>*</sup></label>
                                <select name="designation_id" class="form-control" required>
                                    <option>Select Designation</option>
                                    @foreach($designations as $designation)
                                        <option value="{{$designation->id}}" {{($designation->id == $employee->designation_id)?"selected":""}} >{{$designation->title}}</option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Details</label>
                                <textarea name="details" class="form-control">{{old('details',$employee->details)}}</textarea>
                                @error('details')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                                @error('details')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div style="width:200px;height: 150px;">
                                    @if(isset($employee->image))
                                    <img src="{{asset('assets/admin/images/employee/')}}/{{$employee->image}}" alt="employee image" width="100%">
                                    @endif
                                </div>
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
