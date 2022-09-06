@extends('layouts.admin.master')
@section('title', 'Import Student By Excel')
@section('custome-css')
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Import Student By Excel</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Import Student By Excel</li>
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
                    <h4 class="card-title">Import Student By Excel</h4>
                    <p class="card-title-desc">Import Student By Excel here....!</p>
                    @include('_message')
                    <form action="{{ route('submit.import.student') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Excel File<sup>*</sup></label>
                                    <input class="form-control" name="file" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"  required>
                                    @error('file')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-lg" type="submit">Import</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <!-- end row -->
@endsection
