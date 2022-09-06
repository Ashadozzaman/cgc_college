@extends('layouts.admin.master')
@section('title', 'Student Edit')
@section('custome-css')
    <style>
        /* .student-personal input{
                    padding: 3px;
                } */
    </style>
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Student Update</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Student Update</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    @include('_message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-11">
                            <h4 class="card-title">Update Student</h4>
                            <p class="card-title-desc">Update Student here....!</p>
                        </div>
                        <div class="col-md-1">
                            <a href="{{route('get.personal.result',$student->student_id)}}" class="btn btn-info"> Result </a>
                        </div>
                    </div>
                    <form action="{{ route('student.details.update', $student->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="department-team">
                                    <div class="team-image">
                                        @if ($student->image)
                                            <img src="{{ asset('/') }}assets/front/images/user/{{ $student->image }}"
                                                class="img-responsive" alt="">
                                        @else
                                            <img src="{{ asset('/') }}assets/front/images/demo-profile.jpg"
                                                class="img-responsive" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 student-details" style="padding:0;">
                                <h4>About {{ $student->full_name }}</h4>
                                <hr>
                                <div class="row student-personal">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="">Full Name<sup></sup></label>
                                            <input type="text" class="form-control" name="full_name"
                                                value="{{ old('full_name', $student->full_name) }}" required
                                                style="padding: 3px;">
                                            @error('full_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="">Student Id<sup></sup></label>
                                            <input type="text" class="form-control" name="student_id"
                                                value="{{ old('student_id', $student->student_id) }}" required>
                                            @error('student_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="">Class Roll<sup></sup></label>
                                            <input type="text" class="form-control" name="class_roll"
                                                value="{{ old('class_roll', $student->class_roll) }}" required>
                                            @error('class_roll')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="">Session<sup>*</sup></label>
                                            <input type="text" class="form-control" name="education_year"
                                                value="{{ old('education_year', $student->education_year) }}" required>
                                            @error('education_year')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="">SSC Roll<sup>*</sup></label>
                                            <input type="text" class="form-control" name="ssc_roll"
                                                value="{{ old('ssc_roll', $student->ssc_roll) }}" required>
                                            @error('ssc_roll')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="">SSC Registration<sup>*</sup></label>
                                            <input type="text" class="form-control" name="ssc_reg"
                                                value="{{ old('ssc_reg', $student->details->ssc_reg) }}" required>
                                            @error('ssc_reg')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="">Certificate</label>
                                            <select name="certificate_id" id="" class="form-control" required>
                                                @foreach ($certificates as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $student->certificate_id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('certificate_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="">Section<sup></sup></label>
                                            <select name="section_id" id="" required class="form-control">
                                                <option value="">Select Group</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}"
                                                        {{ $section->id == $student->section_id ? 'selected' : '' }}>
                                                        {{ $section->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('section_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Gender<sup>*</sup></label>
                                        <select name="gender" required="" class="form-control">
                                            <option value="M" {{ $student->gender == 'M' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="F" {{ $student->gender == 'F' ? 'selected' : '' }}>Female
                                            </option>
                                        </select>
                                        <p class="text-danger-error" id="gender_error"></p>
                                        @error('gender')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Email<sup></sup></label>
                                    <input type="email" class="form-control" placeholder="Enter email address"
                                        name="email" value="{{ old('email', $student->email) }}">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Phone Number<sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Enter phone number"
                                        name="phone" value="{{ old('phone', $student->phone) }}" required="">
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">SSC Board<sup>*</sup></label>
                                <input type="text" class="form-control" name="ssc_board"
                                    value="{{ old('ssc_board', $student->ssc_board) }}">
                                @error('ssc_board')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">School Name<sup></sup></label>
                                    <input type="text" class="form-control" name="school"
                                        value="{{ old('school', $student->details->school) }}" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">SSC Registration<sup></sup></label>
                                    <input type="text" class="form-control" name="ssc_reg"
                                        value="{{ old('ssc_reg', $student->details->ssc_reg) }}" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">SSC GPA<sup></sup></label>
                                    <input type="text" class="form-control" name="ssc_gpa"
                                        value="{{ old('ssc_gpa', $student->details->ssc_gpa) }}" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">SSC GPA With 4th<sup></sup></label>
                                    <input type="text" class="form-control" name="ssc_gpa_forth"
                                        value="{{ old('ssc_gpa_forth', $student->details->ssc_gpa_forth) }}"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Date Of Birth<sup></sup></label>
                                    <input type="date" class="form-control" name="dob"
                                        value="{{ old('dob', $student->details->dob) }}" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Nationality<sup></sup></label>
                                    <input type="text" class="form-control" name="nationality"
                                        value="{{ old('nationality', $student->details->nationality) }}" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Father Name<sup><b>*</b></sup></label>
                                    <input type="text" class="form-control" placeholder="Enter father name"
                                        name="father_name"
                                        value="{{ old('father_name', $student->details->father_name) }}" required="">
                                    @error('father_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Mother Name<sup><b>*</b></sup></label>
                                    <input type="text" class="form-control" name="mother_name"
                                        value="{{ old('mother_name', $student->details->mother_name) }}" required="">
                                    @error('mother_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Father NID<sup></sup></label>
                                    <input type="text" class="form-control" name="father_nid"
                                        value="{{ old('father_nid', $student->details->father_nid) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Father Occupation<sup></sup></label>
                                    <input type="text" class="form-control" name="father_occupation"
                                        value="{{ old('father_occupation', $student->details->father_occupation) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Mother NID<sup></sup></label>
                                    <input type="text" class="form-control" name="mother_nid"
                                        value="{{ old('mother_nid', $student->details->mother_nid) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Mother Occupation<sup></sup></label>
                                    <input type="text" class="form-control" name="mother_occupation"
                                        value="{{ old('mother_occupation', $student->details->mother_occupation) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Father Yearly Income<sup></sup></label>
                                    <input type="text" class="form-control" name="father_yearly_income"
                                        value="{{ old('father_yearly_income', $student->details->father_yearly_income) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Parents Phone<sup></sup></label>
                                    <input type="text" class="form-control" name="parents_phone"
                                        value="{{ old('parents_phone', $student->details->parents_phone) }}"
                                        required="">
                                    @error('parents_phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Mother Yearly Income<sup></sup></label>
                                    <input type="text" class="form-control" name="mother_yearly_income"
                                        value="{{ old('mother_yearly_income', $student->details->mother_yearly_income) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Birth Registration<sup></sup></label>
                                    <input type="text" class="form-control" name="birth_registration"
                                        value="{{ old('birth_registration', $student->details->birth_registration) }}"
                                        required="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Marital Status<sup></sup></label>
                                    <select name="marital_status" class="form-control">
                                        <option value="Unmarried"
                                            {{ $student->details->marital_status == 'Unmarried' ? 'selected' : '' }}>
                                            Unmarried</option>
                                        <option value="Married"
                                            {{ $student->details->marital_status == 'Married' ? 'selected' : '' }}>Married
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Religion<sup></sup></label>
                                    <select name="religion" class="form-control">
                                        <option value="ISLAM"
                                            {{ $student->details->religion == 'ISLAM' ? 'selected' : '' }}>ISLAM</option>
                                        <option value="BUDDHISM"
                                            {{ $student->details->religion == 'BUDDHISM' ? 'selected' : '' }}>BUDDHISM
                                        </option>
                                        <option value="CHRISTIANITY"
                                            {{ $student->details->religion == 'CHRISTIANITY' ? 'selected' : '' }}>
                                            CHRISTIANITY</option>
                                        <option value="HINDUISM"
                                            {{ $student->details->religion == 'HINDUISM' ? 'selected' : '' }}>HINDUISM
                                        </option>
                                        <option value="JAINISM"
                                            {{ $student->details->religion == 'JAINISM' ? 'selected' : '' }}>JAINISM
                                        </option>
                                        <option value="JUDAISM"
                                            {{ $student->details->religion == 'JUDAISM' ? 'selected' : '' }}>JUDAISM
                                        </option>
                                        <option value="OTHERS"
                                            {{ $student->details->religion == 'OTHERS' ? 'selected' : '' }}>OTHERS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Present Address<sup></sup></label>
                                    <input type="text" class="form-control" name="permanent_address"
                                        value="{{ old('permanent_address', $student->details->permanent_address) }}"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Present Address<sup></sup></label>
                                    <input type="text" class="form-control" name="present_address"
                                        value="{{ old('present_address', $student->details->present_address) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Local Guardian Name<sup></sup></label>
                                    <input type="text" class="form-control" name="local_guardian_name"
                                        value="{{ old('local_guardian_name', $student->details->local_guardian_name) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Relation with Local Guardian<sup></sup></label>
                                    <input type="text" class="form-control" name="relation_local_guardian"
                                        value="{{ old('relation_local_guardian', $student->details->relation_local_guardian) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Local Guardian Phone<sup></sup></label>
                                    <input type="text" class="form-control" name="local_guardian_mobile"
                                        value="{{ old('local_guardian_mobile', $student->details->local_guardian_mobile) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Blood Group<sup></sup></label>
                                    <input type="text" class="form-control" name="blood_group"
                                        value="{{ old('blood_group', $student->details->blood_group) }}" required="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Profile Image<sup>*</sup></label>
                                    <input type="file" class="form-control" name="image">
                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Password<sup><b>*</b></sup></label>
                                    <input type="password" class="form-control" placeholder="Enter password "
                                        name="password">
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Password Confirmation<sup><b>*</b></sup></label>
                                    <input type="password" class="form-control" placeholder="Enter confirm password"
                                        name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>

                    </form>
                    <br>
                    <h4>Subjects </h4>
                    <hr>
                    @foreach ($student->subject->sortBy('id') as $val)
                        <label style="margin-right: 7px"><u>{{ $val->details->name }}
                                ({{ $val->details->subject_code }})
                            </u>
                            <sup>{{ $val->details->subject_status == '4th' ? $val->details->subject_status : '' }}</sup>
                            ||</label>
                    @endforeach
                    <hr>
                    <h3>Subject Change</h3>
                    <hr>
                    <form action="{{ route('change.subject.submit') }}" method="POST" id="submit-form">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $student->id }}">
                        <div class="row" style="padding: 10px">
                            @foreach ($subjects as $key => $subject)
                                <div class="col-md-4" style="padding: 0;">
                                    <div class="subject-select">
                                        <input type="hidden" id="limit_{{ $subject['name'] }}"
                                            value="{{ $subject['limit_subject'] }}">
                                        @if ($student->section_id == 2)
                                            <input type="hidden" id="selected_subject_{{ $subject['name'] }}"
                                                value="6">
                                        @else
                                            <input type="hidden" id="selected_subject_{{ $subject['name'] }}"
                                                value="2">
                                        @endif
                                        <h4>{{ $subject['name'] }} ({{ $subject['title'] }})</h4>
                                        <h6>Please Choose {{ $subject['limit_subject'] }} Major Subject.
                                            <p class="text-danger" id="subject_error_{{ $subject['name'] }}"></p>
                                        </h6>
                                        <hr>
                                        @foreach ($subject['sub_subjects'] as $key1 => $sub)
                                            <div class="form-group" style="margin-bottom: 0">
                                                <input
                                                    class="subject {{ $subject['name'] }}_code_{{ $sub['subject_code'] }} 
                                                status_{{ $subject['name'] }} 
                                                status_{{ $subject['name'] }}_{{ $key1 }} 
                                                main_{{ $sub['main_subject_id'] }}_status_{{ $subject['name'] }}"
                                                    name="sub_subject[]" type="checkbox" value="{{ $sub['id'] }}"
                                                    section="{{ $student->section_id }}"
                                                    code="{{ $sub['subject_code'] }}"
                                                    main-subject="{{ $sub['main_subject_id'] }}"
                                                    subject-status="{{ $subject['name'] }}"
                                                    id="subject_{{ $sub['id'] }}" subject-name="{{ $sub['name'] }}"
                                                    multiple {{ $subject['name'] == 'Compulsory' ? 'checked' : '' }}
                                                    {{ in_array($sub['id'], $choose_subjects) ? 'checked' : '' }}>
                                                <label for="subject_{{ $sub['id'] }}">
                                                    {{ $sub['name'] }} </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($resultGenerate == 0)
                        <button class="btn btn-success change-subject" type="button">Change Subject</button>
                        @endif
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
    <script>
        $(document).ready(function() {
            //set initial state.
            $(".subject").change(function() {
                if ($(this).is(":checked")) {
                    var code = $(this).attr("code");
                    var main_subject = $(this).attr("main-subject");
                    var status = $(this).attr("subject-status");
                    var section = $(this).attr("section");
                    if (status === "Elective") {
                        var disabled_status = "4th";
                        if (section != 2) {
                            $(".status_" + status).prop("checked", false);
                            $(".status_" + status).prop("disabled", true);
                        } else {
                            var count = 1;
                            for (let i = 0; i < 10; i++) {
                                if ($(".status_" + status + "_" + i).is(":checked")) {
                                    count = count + 1;
                                }
                            }
                            if (count > 5) {
                                for (let i = 0; i < 10; i++) {
                                    if (
                                        $(".status_" + status + "_" + i).is(
                                            ":not(:checked)"
                                        )
                                    ) {
                                        $(".status_" + status + "_" + i).prop(
                                            "disabled",
                                            true
                                        );
                                    }
                                }
                            }
                            //console.log(count);
                        }
                    } else if (status === "4th") {
                        var disabled_status = "Elective";
                        $(".status_" + status).prop("checked", false);
                        $(".status_" + status).prop("disabled", true);
                    }
                    var limit_val = $("#limit_" + status).val();
                    $(".main_" + main_subject + "_status_" + status).prop(
                        "checked",
                        true
                    );
                    $(".main_" + main_subject + "_status_" + status).prop(
                        "disabled",
                        false
                    );
                    $(".main_" + main_subject + "_status_" + disabled_status).prop(
                        "checked",
                        false
                    );
                    $(".main_" + main_subject + "_status_" + disabled_status).prop(
                        "disabled",
                        true
                    );
                    // console.log(limit_val);
                    $(".subject-list-class-" + status).html("");
                    var selected_subject = 0;
                    for (let s = 0; s < 10; s++) {
                        if ($(".status_" + status + "_" + s).is(":checked")) {
                            selected_subject = parseInt(selected_subject) + 1;
                            var subject_name = $(".status_" + status + "_" + s).attr(
                                "subject-name"
                            );
                            var code = $(".status_" + status + "_" + s).attr("code");
                            var html =
                                `<strong id="">` +
                                subject_name +
                                ` (` +
                                code +
                                `)</strong><br>`;
                            $(".subject-list-class-" + status).append(html);
                        }
                    }
                    $('#selected_subject_' + status).val(selected_subject);
                } else {
                    var code = $(this).attr("code");
                    var main_subject = $(this).attr("main-subject");
                    var status = $(this).attr("subject-status");
                    var section = $(this).attr("section");
                    if (status === "Elective") {
                        var disabled_status = "4th";
                        if (section != 2) {
                            $('.status_' + status).prop('disabled', false);
                            $('.status_' + status).prop('checked', false);
                        } else {
                            var count = -1;
                            for (let i = 0; i < 10; i++) {
                                if ($(".status_" + status + "_" + i).is(":checked")) {
                                    count = count + 1;
                                }
                            }
                            if (count < 5) {
                                for (let j = 0; j < 10; j++) {
                                    if (
                                        $(".status_" + status + "_" + j).prop(
                                            "disabled"
                                        ) == true
                                    ) {
                                        $(".status_" + status + "_" + j).prop(
                                            "disabled",
                                            false
                                        );
                                    }

                                    for (let k = 0; k < 10; k++) {
                                        if (
                                            $(
                                                ".status_" + disabled_status + "_" + k
                                            ).is(":checked")
                                        ) {
                                            var code = $(
                                                ".status_" + disabled_status + "_" + k
                                            ).attr("code");
                                            $("." + status + "_code_" + code).prop(
                                                "disabled",
                                                true
                                            );
                                        }
                                    }
                                }
                            }
                        }
                    } else if (status === "4th") {
                        var disabled_status = "Elective";
                        $(".status_" + status).prop("disabled", false);
                        $(".status_" + status).prop("checked", false);
                        if (section == 2) {
                            for (let i = 0; i < 10; i++) {
                                if (
                                    $(".status_" + disabled_status + "_" + i).is(
                                        ":checked"
                                    )
                                ) {
                                    var code = $(
                                        ".status_" + disabled_status + "_" + i
                                    ).attr("code");
                                    $("." + status + "_code_" + code).prop(
                                        "disabled",
                                        true
                                    );
                                }
                            }

                            var el_count = 0;
                            for (let i = 0; i < 10; i++) {
                                if (
                                    $(".status_" + disabled_status + "_" + i).is(
                                        ":checked"
                                    )
                                ) {
                                    el_count = el_count + 1;
                                }
                            }
                            // console.log("El:" + el_count);
                        }
                    }

                    $(".main_" + main_subject + "_status_" + disabled_status).prop(
                        "checked",
                        false
                    );
                    $(".main_" + main_subject + "_status_" + disabled_status).prop(
                        "disabled",
                        false
                    );
                    $(".main_" + main_subject + "_status_" + status).prop(
                        "checked",
                        false
                    );
                    if (status === "Elective") {
                        for (let t = 0; t < 10; t++) {
                            if (
                                $(".status_" + disabled_status + "_" + t).is(":checked")
                            ) {
                                $(
                                    ".main_" +
                                    main_subject +
                                    "_status_" +
                                    disabled_status
                                ).prop("disabled", true);
                            }
                        }
                    } else if (status === "4th") {
                        if (el_count > 5) {
                            $(
                                ".main_" + main_subject + "_status_" + disabled_status
                            ).prop("disabled", true);
                        }
                    }
                    if (status === "Compulsory") {
                        $(".main_" + main_subject + "_status_" + status).prop(
                            "checked",
                            true
                        );
                    }
                    $(".subject-list-class-" + status).html("");
                    var selected_subject = 0;
                    for (let s = 0; s < 10; s++) {
                        if ($(".status_" + status + "_" + s).is(":checked")) {
                            selected_subject = selected_subject + 1;
                            var subject_name = $(".status_" + status + "_" + s).attr(
                                "subject-name"
                            );
                            var code = $(".status_" + status + "_" + s).attr("code");
                            var html =
                                `<strong id="">` +
                                subject_name +
                                ` (` +
                                code +
                                `)</strong><br>`;
                            $(".subject-list-class-" + status).append(html);
                        }
                    }
                    $('#selected_subject_' + status).val(selected_subject);
                }

            })

            $('.change-subject').click(function() {
                var limit_Elective = $("#limit_Elective").val();
                var limit_4th = $("#limit_4th").val();
                var selected_subject_Elective = parseInt($("#selected_subject_Elective").val()) / 2;
                var selected_subject_4th = parseInt($("#selected_subject_4th").val()) / 2;
                if (limit_Elective != selected_subject_Elective) {
                    $("#subject_error_Elective").addClass("errorScroll");
                    $(".errorScroll").html("Please complete elective subject selection");
                    return false;
                } else {
                    $("#subject_error_Elective").html("");
                    $("#subject_error_Elective").removeClass("errorScroll");
                }
                if (limit_4th != selected_subject_4th) {
                    $("#subject_error_4th").addClass("errorScroll");
                    $(".errorScroll").html("Please complete 4th subject selection");
                    return false;
                } else {
                    $("#subject_error_4th").html("");
                    $("#subject_error_4th").removeClass("errorScroll");
                }
                // confirm('Are you sure change subject');
                $("#submit-form").submit(); // Submit the form
            })



            // ====================================
            function checkSubject(){
                var selected_subject = 0;
                var status = '4th';
                for (let s = 0; s < 15; s++) {
                    if ($(".status_" + status + "_" + s).is(":checked")) {
                        selected_subject = parseInt(selected_subject) + 1;
                    }else{
                        $(".status_" + status + "_" + s).prop('disabled',true);
                    }
                }
                $('#selected_subject_' + status).val(selected_subject);

                var selected_subject_e = 0;
                var status = 'Elective';
                for (let e = 0; e < 15; e++) {
                    if ($(".status_" + status + "_" + e).is(":checked")) {
                        selected_subject_e = parseInt(selected_subject_e) + 1;
                    }else{
                        $(".status_" + status + "_" + e).prop('disabled',true);
                    }
                }
                $('#selected_subject_' + status).val(selected_subject_e);

            }
            checkSubject();
        })
    </script>
@endsection
