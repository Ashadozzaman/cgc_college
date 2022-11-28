@extends('layouts.admin.master')
@section('title','Result History') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Result History</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Add Notice</li>
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
                <h4 class="card-title">Result History</h4>
                <p class="card-title-desc">Create Result History here....!</p>
                @include('_message')
                <form action="{{route('result_history.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Session<sup>*</sup></label>
                                <select name="session_id" class="form-control" required>
                                    <option value="">Select Session</option>
                                    @php
                                        $start = (int)date('Y') - 10;
                                    @endphp
                                    @for ($i = $start; $i < (int)date('Y'); $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                @error('session_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Section<sup>*</sup></label>
                                <select name="section_id" class="form-control" required>
                                    <option value="">Select Section</option>
                                    @foreach ($sections as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label>Total Seat<sup>*</sup></label>
                                <input type="number" class="form-control" name="total_seat" required>
                                @error('total_seat')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label>Total Enrolled<sup>*</sup></label>
                                <input type="number" class="form-control" name="total_enrolled" required>
                                @error('total_enrolled')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label>Total Appeared<sup>*</sup></label>
                                <input type="number" class="form-control" name="total_appeared" required>
                                @error('total_appeared')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <h3 class="col-md-12">Grade <hr></h3>
                        <div class="col-md-2">
                            <div class="mb-4">
                                <label>A<sup>+</sup></label>
                                <input type="number" class="form-control" name="ap" value="0">
                                @error('ap')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-4">
                                <label>A<sup></sup></label>
                                <input type="number" class="form-control" name="a"  value="0">
                                @error('a')
                                    <p class="text-danger {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-4">
                                <label>A<sup>-</sup></label>
                                <input type="number" class="form-control" name="am"  value="0">
                                @error('am')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-4">
                                <label>B<sup></sup></label>
                                <input type="number" class="form-control" name="b"  value="0">
                                @error('b')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-4">
                                <label>C<sup></sup></label>
                                <input type="number" class="form-control" name="c"  value="0">
                                @error('c')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-4">
                                <label>D<sup></sup></label>
                                <input type="number" class="form-control" name="d"  value="0">
                                @error('d')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label>Absent<sup></sup></label>
                                <input type="number" class="form-control" name="absent"  value="0">
                                @error('absent')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label>Fail<sup></sup></label>
                                <input type="number" class="form-control" name="fail"  value="0">
                                @error('fail')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label>Pass<sup></sup></label>
                                <input type="number" class="form-control" name="pass" required>
                                @error('pass')
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