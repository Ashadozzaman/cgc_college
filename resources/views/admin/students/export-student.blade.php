@extends('layouts.admin.master')
@section('title', 'Export Students')
@section('custome-css')

    <link href="{{ asset('/') }}assets/admin/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Export Students</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Export Students</li>
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
                    <h4 class="card-title">Export Students</h4>
                    <p class="card-title-desc">Export Students here....!</p>
                    @include('_message')
                    <form action="{{ route('submit.export.student') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <div class="form-group mb-0">
                                        <label class="control-label">Select Important Info</label>
                                        <select name="important_info[]" class="select2 form-control select2-multiple"
                                            multiple="multiple"data-placeholder="Select Important Info" >
                                            <option value="full_name">Full Name</option>
                                            <option value="ssc_roll">SSC Roll</option>
                                            <option value="student_id">Student ID</option>
                                            <option value="class_roll">Class Roll</option>
                                            <option value="phone">Phone</option>
                                            <option value="email">Email</option>
                                            <option value="gender">Gender</option>
                                            <option value="ssc_board">SSC Board</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <div class="form-group mb-0">
                                        <label class="control-label">Select Optional Info</label>
                                        <select name="optional_info[]" class="select2 form-control select2-multiple"
                                            multiple="multiple"data-placeholder="Select Optional Info" >
                                            <option value="ssc_reg">SSC REG.</option>
                                            <option value="school">School</option>
                                            <option value="ssc_gpa">SSC GPA</option>
                                            <option value="ssc_gpa_forth">SSC GPA FORTH</option>
                                            <option value="dob">Date Of Birth</option>
                                            <option value="nationality">Nationality</option>
                                            <option value="father_name">Father Name</option>
                                            <option value="father_nid">Father NID</option>
                                            <option value="father_occupation">Father Occupation</option>
                                            <option value="mother_name">Mother Name</option>
                                            <option value="mother_nid">Mother NID</option>
                                            <option value="mother_occupation">Mother Occupation</option>
                                            <option value="father_yearly_income">Father Yearly Income</option>
                                            <option value="parents_phone">Parents Phone</option>
                                            <option value="mother_yearly_income">Mother Yearly Income</option>
                                            <option value="birth_registration">Birth Registration</option>
                                            <option value="marital_status">Marital Status</option>
                                            <option value="religion">Religion</option>
                                            <option value="permanent_address">Permanent Address</option>
                                            <option value="present_address">Present Address</option>
                                            <option value="local_guardian_name">Local Guardian Name</option>
                                            <option value="relation_local_guardian">Relation With Local Guardian</option>
                                            <option value="local_guardian_mobile">Local Guardian Mobile</option>
                                            <option value="blood_group">Blood Group</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label>Session<sup>*</sup></label>
                                    <select name="education_year" class="form-control" required>
                                        @for ($i = (date('Y')-2); $i < date('Y')+1; $i++)
                                            <option value="{{$i}}">{{$i - 1}}-{{$i}}</option>
                                        @endfor
                                    </select>
                                    @error('education_year')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label>Section<sup>*</sup></label>
                                    <select name="section_id" class="form-control" required>
                                        <option value="">Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
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
                        </div>
                        <button class="btn btn-primary btn-lg" type="submit">Export</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <!-- end row -->
@endsection

@section('custome-js')
    <script src="{{ asset('/') }}assets/admin/libs/select2/js/select2.min.js"></script>

    <!-- form advanced init -->
    <script src="{{ asset('/') }}assets/admin/js/pages/form-advanced.init.js"></script>
@endsection
