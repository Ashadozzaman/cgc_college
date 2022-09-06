@extends('layouts.admin.master')
@section('title','Dasboard') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Teacher Add</h4>

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
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sizing</h4>
                <p class="card-title-desc">Set heights using classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>.</p>
                <div>
                    <div class="mb-4">
                        <input class="form-control" type="text" placeholder="Default input">
                    </div>
                    <div class="mb-4">
                        <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
                    </div>
                    <div>
                        <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<!-- end row -->
@endsection