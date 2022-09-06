@extends('layouts.front.master')
@section('title', 'Home Page')
@section('custome-css')
@endsection
@section('content')
    <!-- CONTACT -->
    <div class="container">
        @include('_message')
        <section class="registration" id="contact">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('user.profile.update', $student->id) }}" method="POST"
                        enctype="multipart/form-data" id="contact-form">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="department-team" style="min-height: auto;width:150px;">
                                    <div class="team-image-">
                                        @if ($student->image)
                                            <img src="{{ asset('/') }}assets/front/images/user/{{ $student->image }}"
                                                class="img-responsive" alt="">
                                        @else
                                            <img src="{{ asset('/') }}assets/front/images/demo-profile.jpg"
                                                class="img-responsive" alt=""  height="200">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 student-details" style="padding:0;">
                                <h4 class="col-md-9">About {{ $student->full_name }}<hr></h4>
                                <a href="{{route('print.adminssion.form',$student->id)}}" class="col-md-3 btn btn-info" target="_blank"><i class="fa fa-print"></i> Print Admission Form</a>
                                <hr>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <label class="first-label">Name</label> <label class="second-lebel">:
                                            {{ $student->full_name }}</label><br>
                                        <label class="first-label">Student ID </label> <label class="second-lebel">:
                                            {{ $student->student_id }}</label><br>
                                        <label class="first-label">Class Roll </label> <label class="second-lebel">:
                                            {{ $student->class_roll }}</label><br>
                                        <label class="first-label">Session </label> <label class="second-lebel">:
                                            {{ $student->education_year }}</label><br>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="first-label">SSC Roll</label> <label class="second-lebel">:
                                            {{ $student->ssc_roll }}</label><br>
                                            <label class="first-label">SSC Registration </label> <label class="second-lebel">:
                                                {{ $student->details->ssc_reg }}</label><br>
                                        <label class="first-label">Certificate </label> <label class="second-lebel">:
                                            {{ $student->certificate->name }}</label><br>
                                        <label class="first-label">HSC Group </label> <label class="second-lebel">:
                                            {{ $student->section->name }}</label><br>
                                    </div>
                                </div>
                                <br>
                                <br>
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
                            <div class="col-md-4" style="margin-bottom: 8px;">
                                <div class="mb-4">
                                    <label for="">Gender<sup>*</sup></label>
                                    <select  class="form-control" name="gender" required>
                                        <option value="M" {{ ($student->gender == 'M')?'selected':''; }}>Male</option>
                                        <option value="F" {{ ($student->gender == 'F')?'selected':''; }}>Female</option>
                                    </select>
                                    <p class="text-danger-error" id="gender_error"></p>
                                    @error('gender')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div><br>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">School Name<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="school" value="{{ old('school', $student->details->school) }}"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">SSC Registration<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="ssc_reg" value="{{ old('ssc_reg', $student->details->ssc_reg) }}"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">SSC GPA<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="ssc_gpa" value="{{ old('ssc_gpa', $student->details->ssc_gpa) }}"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">SSC GPA With 4th<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="ssc_gpa_forth" value="{{ old('ssc_gpa_forth', $student->details->ssc_gpa_forth) }}"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Date Of Birth<sup></sup></label>
                                    <input type="date" class="form-control"
                                        name="dob" value="{{ old('dob', $student->details->dob) }}"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Nationality<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="nationality" value="{{ old('nationality', $student->details->nationality) }}"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Father Name<sup><b>*</b></sup></label>
                                    <input type="text" class="form-control" placeholder="Enter father name"
                                        name="father_name" value="{{ old('father_name', $student->details->father_name) }}"
                                        required="">
                                    @error('father_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Mother Name<sup><b>*</b></sup></label>
                                    <input type="text" class="form-control"
                                        name="mother_name" value="{{ old('mother_name', $student->details->mother_name) }}"
                                        required="">
                                    @error('mother_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Father NID<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="father_nid" value="{{ old('father_nid', $student->details->father_nid) }}"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Father Occupation<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="father_occupation" value="{{ old('father_occupation', $student->details->father_occupation) }}"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Mother NID<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="mother_nid" value="{{ old('mother_nid', $student->details->mother_nid) }}"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Mother Occupation<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="mother_occupation" value="{{ old('mother_occupation', $student->details->mother_occupation) }}"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Father Yearly Income<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="father_yearly_income" value="{{ old('father_yearly_income', $student->details->father_yearly_income) }}"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Parents Phone<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="parents_phone" value="{{ old('parents_phone', $student->details->parents_phone) }}"
                                        required="">
                                    @error('parents_phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Mother Yearly Income<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="mother_yearly_income" value="{{ old('mother_yearly_income', $student->details->mother_yearly_income) }}"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Birth Registration<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="birth_registration" value="{{ old('birth_registration', $student->details->birth_registration) }}"
                                        required="">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Marital Status<sup></sup></label>
                                    <select name="marital_status" class="form-control">
                                        <option value="Unmarried" {{ ($student->details->marital_status == 'Unmarried')?'selected':''; }}>Unmarried</option>
                                        <option value="Married" {{ ($student->details->marital_status == 'Married')?'selected':''; }}>Married</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Religion<sup></sup></label>
                                    <select name="religion" class="form-control">
                                        <option value="ISLAM" {{ ($student->details->religion == 'ISLAM')?'selected':''; }}>ISLAM</option>
                                        <option value="BUDDHISM" {{ ($student->details->religion == 'BUDDHISM')?'selected':''; }}>BUDDHISM</option>
                                        <option value="CHRISTIANITY" {{ ($student->details->religion == 'CHRISTIANITY')?'selected':''; }}>CHRISTIANITY</option>
                                        <option value="HINDUISM" {{ ($student->details->religion == 'HINDUISM')?'selected':''; }}>HINDUISM</option>
                                        <option value="JAINISM" {{ ($student->details->religion == 'JAINISM')?'selected':''; }}>JAINISM</option>
                                        <option value="JUDAISM" {{ ($student->details->religion == 'JUDAISM')?'selected':''; }}>JUDAISM</option>
                                        <option value="OTHERS" {{ ($student->details->religion == 'OTHERS')?'selected':''; }}>OTHERS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Present Address<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="permanent_address" value="{{ old('permanent_address', $student->details->permanent_address) }}"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Present Address<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="present_address" value="{{ old('present_address', $student->details->present_address) }}"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Local Guardian Name<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="local_guardian_name" value="{{ old('local_guardian_name', $student->details->local_guardian_name) }}"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Relation with Local Guardian<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="relation_local_guardian" value="{{ old('relation_local_guardian', $student->details->relation_local_guardian) }}"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Local Guardian Phone<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="local_guardian_mobile" value="{{ old('local_guardian_mobile', $student->details->local_guardian_mobile) }}"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="">Blood Group<sup></sup></label>
                                    <input type="text" class="form-control"
                                        name="blood_group" value="{{ old('blood_group', $student->details->blood_group) }}"
                                        required="">
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
                        <button class="btn btn-success btn-lg" type="submit">Update</button>
                    </form>
                    <div class="col-md-12">
                        
                        <h4 style="color: #ffffff">Your Subjects <small style="color: #ffffff">(If you want to change your 4th subject please contact in college.)</small></h4>
                        <hr>
                        @foreach ($student->subject->sortBy('id') as $val)
                            <label style="margin-right: 7px"><u>{{ $val->details->name }}
                                    ({{ $val->details->subject_code }})</u>
                                <sup>{{ ($val->details->subject_status == '4th' )?$val->details->subject_status : '' }}</sup>  ||</label>
                        @endforeach
                    </div>
                </div>
                {{-- <div class="col-md-6 col-sm-12">
                <div class="contact-image">
                    <img src="{{asset('/')}}assets/front/images/contact-image.jpg" class="img-responsive" alt="Smiling Two Girls" width="90%">
                </div>
            </div> --}}
            </div>
        </section>
    </div>
@endsection
