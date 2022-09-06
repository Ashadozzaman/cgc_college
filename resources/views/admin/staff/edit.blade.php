@extends('layouts.admin.master')
@section('title','Staff Edit') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Staff Update</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Add Staff</li>
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
                <h4 class="card-title">Update Staff</h4>
                <p class="card-title-desc">Update Staff here....!</p>
                <form action="{{route('staff.update',$staff->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Name<sup>*</sup></label>
                                <input class="form-control" name="name"  type="text" placeholder="Enter name" value="{{old('name',$staff->name)}}" required>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Phone<sup>*</sup></label>
                                <input class="form-control" name="phone"  type="text" placeholder="Enter phone number" value="{{old('phone',$staff->phone)}}"  required>
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Address<sup>*</sup></label>
                                <input class="form-control" name="address"  type="text" placeholder="Enter address" value="{{old('address',$staff->address)}}"  required>
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Age<sup>*</sup></label>
                                <input class="form-control" name="age" value="{{old('age',$staff->age)}}"  type="number" placeholder="Enter age" required>
                                @error('age')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Gender<sup>*</sup></label>
                                <select name="gender" class="form-control"  required>
                                    <option value="male" {{($staff->gender == "male")?"selected":""}}>Male</option>
                                    <option value="female" {{($staff->gender == "female")?"selected":""}}>Fe-male</option>
                                </select>
                                @error('gender')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Email<sup></sup></label>
                                <input class="form-control" name="email" value="{{old('email',$staff->email)}}" type="text" placeholder="Enter email">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Joining Date<sup></sup></label>
                                <input class="form-control" name="joining_date"  type="date" placeholder="Joining date" value="{{old('joining_date',$staff->joining_date)}}">
                                @error('joining_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Order By<sup>*</sup></label>
                                <input class="form-control" name="order_by" type="number" placeholder="Enter Order Number" min="1" required value="{{old('order_by',$staff->order_by)}}">
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
                                        <option value="{{$designation->id}}" {{($designation->id == $staff->designation_id)?"selected":""}} >{{$designation->title}}</option>
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
                                <textarea name="details" class="form-control">{{old('details',$staff->details)}}</textarea>
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
                            </div>
                            <div style="width:200px;height: 150px;">
                                @if(isset($staff->image))
                                <img src="{{asset('assets/admin/images/staff/')}}/{{$staff->image}}" alt="staff image" width="100%">
                                @endif
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" style="margin-top: 25px;">Update</button>
                    
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<!-- end row -->
@endsection