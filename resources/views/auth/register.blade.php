@extends('layouts.front.master')
@section('title', 'Registration Form')
@section('custome-css')
@endsection
@section('content')
    <!-- MultiStep Form -->
    <div class="container">
        <div id="grad1">
            <div class="row justify-content-center mt-0">
                <div class="col-md-12 p-0 mt-3 mb-2">
                    <div class="card main-card">
                        <h2><strong>Online Admission Form</strong></h2>
                        <p>Fill all form field to go to next step</p>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="text-danger"><b>{{ $error }}</b></div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-md-12 ">
                                <form id="msform" method="POST" action="{{ route('register') }}" autocomplete="on"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active" id="account"><strong>SSC Info</strong></li>
                                        <li id="personal"><strong>Student Information</strong></li>
                                        <li id="payment"><strong>Address</strong></li>
                                        <li id="confirm"><strong>Finish</strong></li>
                                    </ul>
                                    <!-- fieldsets -->
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title">SSC Information</h2>
                                            <h5>সাবধানে নির্বাচন করুন আপনি শুধুমাত্র একবার নির্বাচন করতে পারবেন</h5>
                                            <div class="row student-row">
                                                <div class="col-md-4 mx-0">
                                                    <label for="ssc_roll">SSC Roll</label>
                                                    <input type="number" name="ssc_roll" placeholder="SSC Roll"
                                                        value="{{ $student->ssc_roll }}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">SSC Registration No.</label>
                                                    <input type="number" name="ssc_reg" placeholder="SSC Registration No"
                                                        required value="{{ old('ssc_reg') }}" />
                                                    <p class="text-danger-error" id="ssc_reg_error"></p>
                                                    @error('ssc_reg')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">School Name</label>
                                                    <input type="text" name="school" placeholder="School Name"
                                                        value="{{ old('school') }}" required />
                                                    <p class="text-danger-error" id="school_error"></p>
                                                    @error('school')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">HSC Group</label>
                                                    <input type="hidden" name="section_id"
                                                        value="{{ $student->section_id }}">
                                                    <select name="" id="" class="" required
                                                        disabled="true">
                                                        <option value="">Select Group</option>
                                                        @foreach ($sections as $section)
                                                            <option value="{{ $section->id }}"
                                                                {{ $section->id == $student->section_id ? 'selected' : '' }}>
                                                                {{ $section->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Education Year<sup>*</sup></label>
                                                    <select name="education_year" id="" required>
                                                        <option value="{{ $student->education_year }}" selected>
                                                            {{ date('Y') }}</option>
                                                    </select>
                                                    @error('education_year')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Certificate</label>
                                                    <input type="hidden" name="certificate_id"
                                                        value="{{ $student->certificate_id }}">
                                                    <input type="text"
                                                        value="{{ $student->certificate->name }}" readonly>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Gender<sup>*</sup></label>
                                                    <select name="gender" required="" class="smoothborderSelect">
                                                        <option value="">Select Gender</option>
                                                        <option value="M" {{($student->gender == "M")?"selected":''}}>Male</option>
                                                        <option value="F" {{($student->gender == "F")?"selected":''}}>Female</option>
                                                    </select>
                                                    <p class="text-danger-error" id="gender_error"></p>
                                                    @error('gender')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">SSC GPA(without 4th)<sup>*</sup></label>
                                                    <input type="number" name="ssc_gpa" placeholder="GPA without 4th"
                                                        value="{{ old('ssc_gpa') }}" required />
                                                    <p class="text-danger-error" id="ssc_gpa_error"></p>
                                                    @error('ssc_gpa')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">SSC GPA(with 4th)<sup>*</sup></label>
                                                    <input type="number" name="ssc_gpa_forth" placeholder="GPA with 4th"
                                                        value="{{ old('ssc_gpa_forth') }}" required />
                                                    <p class="text-danger-error" id="ssc_gpa_forth_error"></p>
                                                    @error('ssc_gpa_forth')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                {{-- -------------------------------------------------------------------- --}}
                                                <br>
                                                <h2 class="fs-title col-md-12">Student Information</h2>
                                                <div class="col-md-4">
                                                    <label for="">Student ID<sup>*</sup></label>
                                                    <input type="number" name="student_id" placeholder="Student ID"
                                                        value="{{ $student->student_id }}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Class Roll<sup>*</sup></label>
                                                    <input type="number" name="class_roll" placeholder="Class Roll"
                                                        value="{{ $student->class_roll }}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Date of Birth(According SSC
                                                        Certificate)<sup>*</sup></label>
                                                    <input type="date" name="dob" value="{{ old('dob') }}"
                                                        required />
                                                    <p class="text-danger-error" id="dob_error"></p>
                                                    @error('dob')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Full Name <sup>*</sup></label>
                                                    <input type="text" name="full_name" placeholder="Full Name"
                                                        value="{{ $student->full_name }}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Phone Number</label>
                                                    <input type="text" name="phone" placeholder="Phone Number"
                                                        value="{{ old('phone') }}" />
                                                    <p class="text-danger-error" id="phone_error"></p>
                                                    @error('phone')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Nationality <sup>*</sup></label>
                                                    <input type="text" name="nationality" value="Bangladeshi"
                                                        required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Father Name <sup>*</sup></label>
                                                    <input type="text" name="father_name" placeholder="Father Name"
                                                        value="{{ old('father_name') }}" autocomplete="off" required />
                                                    <p class="text-danger-error" id="father_name_error"></p>
                                                    @error('father_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Father NID</label>
                                                    <input type="number" name="father_nid"
                                                        value="{{ old('father_nid') }}" placeholder="Father NID"
                                                        autocomplete="off" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Father Occupation</label>
                                                    <input type="text" name="father_occupation"
                                                        value="{{ old('father_occupation') }}"
                                                        placeholder="Father Occupation" required />
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Mother Name <sup>*</sup></label>
                                                    <input type="text" name="mother_name"
                                                        value="{{ old('mother_name') }}" placeholder="Mother Name"
                                                        autocomplete="off" required />
                                                    <p class="text-danger-error" id="mother_name_error"></p>
                                                    @error('mother_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Mother NID</label>
                                                    <input type="number" name="mother_nid"
                                                        value="{{ old('mother_nid') }}" placeholder="Mother NID"
                                                        autocomplete="off" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Mother Occupation</label>
                                                    <input type="text" name="mother_occupation"
                                                        value="{{ old('mother_occupation') }}"
                                                        placeholder="Mother Occupation" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Father Yearly Income <sup>*</sup></label>
                                                    <input type="text" name="father_yearly_income"
                                                        value="{{ old('father_yearly_income') }}"
                                                        placeholder="Father Yearly Income" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Parents Phone <sup>*</sup></label>
                                                    <input type="number" name="parents_phone"
                                                        placeholder="Parents phone" value="{{ old('parents_phone') }}"
                                                        required />
                                                    <p class="text-danger-error" id="parents_phone_error"></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Mother Yearly Income</label>
                                                    <input type="number" name="mother_yearly_income"
                                                        value="{{ old('mother_yearly_income') }}"
                                                        placeholder="Mother Yearly Income" required />
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Birth Registration No. <sup></sup></label>
                                                    <input type="number" name="birth_registration"
                                                        placeholder="Birth Registration No."
                                                        value="{{ old('birth_registration') }}" required />
                                                    <p class="text-danger-error" id="birth_registration_error"></p>
                                                    @error('birth_registration')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Marital status<sup>*</sup></label>
                                                    <select name="marital_status" required=""
                                                        class="smoothborderSelect">
                                                        <option value="Unmarried">Unmarried</option>
                                                        <option value="Married">Married</option>
                                                    </select>
                                                    @error('marital_status')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Religion<sup>*</sup></label>
                                                    <select name="religion" required="" class="smoothborderSelect">
                                                        <option value="">Select Religion</option>
                                                        <option value="ISLAM">ISLAM</option>
                                                        <option value="BUDDHISM">BUDDHISM</option>
                                                        <option value="CHRISTIANITY">CHRISTIANITY</option>
                                                        <option value="HINDUISM">HINDUISM</option>
                                                        <option value="JAINISM">JAINISM</option>
                                                        <option value="JUDAISM">JUDAISM</option>
                                                        <option value="OTHERS">OTHERS</option>
                                                        <option value="SIKHISM">SIKHISM</option>
                                                    </select>
                                                    <p class="text-danger-error" id="religion_error"></p>
                                                    @error('religion')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button"
                                            value="Next Step" serial="1" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title">Address Details</h2>
                                            <div class="row address-row">
                                                <div class="col-md-6">
                                                    <label for="">Permanent Address <sup>*</sup></label>
                                                    <input type="text" name="permanent_address"
                                                        placeholder="Permanent Address"
                                                        value="{{ old('permanent_address') }}" required />
                                                    <p class="text-danger-error" id="permanent_address_error"></p>
                                                    @error('permanent_address')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Present Address</label>
                                                    <input type="text" name="present_address"
                                                        placeholder="Present Address"
                                                        value="{{ old('present_address') }}" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Local Guardian Name(If any) [স্থানীয় অভিভাবকের
                                                        (পিতা বা মাতা কুমিল্লায় বসবাস না করলে) নাম] (Optional)</label>
                                                    <input type="text" name="local_guardian_name"
                                                        placeholder="Local Guardian Name"
                                                        value="{{ old('local_guardian_name') }}" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Relation with Local Guardian[শিক্ষার্থীর সাথে
                                                        সম্পর্ক](Optional)</label>
                                                    <input type="text" name="relation_local_guardian"
                                                        placeholder="Relation with Local Guardian"
                                                        value="{{ old('relation_local_guardian') }}" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Local Guardian Mobile No. [টেলিফোন নম্বর]
                                                        (Optional)</label>
                                                    <input type="text" name="local_guardian_mobile"
                                                        placeholder="Local Guardian Mobile No. "
                                                        value="{{ old('local_guardian_mobile') }}" />
                                                </div>
                                            </div>
                                            <h2 class="fs-title">Profile <small>(Student Must Provide Recently Taken
                                                    Passport Size Official Image)</small></h2>
                                            <small class="text-danger"><b>Note:</b>This image will be sent to education
                                                board for your HSC
                                                registration.
                                                Maximum Photo File Size: 100 KB
                                                and Image Dimension Size,
                                                Width: 200 pixel, Height: 200 pixel.</small>
                                            <div class="row address-row">
                                                <div class="col-md-6">
                                                    <label for="">Profile Image <sup>*</sup></label>
                                                    <input type="hidden" id="file_error" value="0">
                                                    <input type="file" name="profile_image" accept="image/*"
                                                        id="imgInp" />
                                                    <p class="text-danger-error" id="file_error_error"></p>
                                                    @error('profile_image')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                    <label for="">Blood Group</label>
                                                    <input type="text" name="blood_group"
                                                        placeholder="Enter blood group" value="{{ old('blood_group') }}">

                                                    <label for="">Email</label>
                                                    <input type="email" name="email" value="{{ old('email') }}"
                                                        placeholder="Enter email">
                                                    <label for="">Password <sup>*</sup> (<small
                                                            class="text-danger"><b>This password use for
                                                                login</b></small>)</label>
                                                    <input type="password" name="password" placeholder="Enter password">
                                                    <p class="text-danger-error" id="password_error"></p>
                                                    <label for="">Confirm Password <sup>*</sup></label>
                                                    <input type="password" name="password_confirmation"
                                                        placeholder="Enter confirm password">
                                                </div>
                                                <div class="col-md-6" width="100%">
                                                    <img id="blah"
                                                        src="{{ asset('/') }}assets/front/images/demo-profile.jpg"
                                                        alt="your image" style="max-height: 200px;max-width: 200px;" />
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous"
                                            value="Previous" />
                                        <input type="button" name="next" class="next action-button"
                                            value="Next Step" serial="2" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card" style="padding: 20px 30px 30px 30px">
                                            <h2 class="fs-title text-center">Select Subject</h2>
                                            @if ($student->section_id == 2)
                                                <h5>৩টি আবশ্যিক, ৩টি নৈর্বাচনিক এবং ১টি ঐচ্ছিক (ইচ্ছা করলে) বিষয় নিতে পারবে।
                                                    একই বিষয় একাধিক নির্বাচন করা যাবে না</h5>
                                            @else
                                                <h5>৫টি আবশ্যিক, ১টি নৈর্বাচনিক এবং ১টি ঐচ্ছিক (ইচ্ছা করলে) বিষয় নিতে পারবে।
                                                    একই বিষয় একাধিক নির্বাচন করা যাবে না</h5>
                                            @endif
                                            <div class="row">
                                                @foreach ($subjects as $key => $subject)
                                                    <div class="col-md-4" style="padding: 0;">
                                                        <div class="subject-select">
                                                            <input type="hidden" id="limit_{{ $subject['name'] }}"
                                                                value="{{ $subject['limit_subject'] }}">
                                                            <input type="hidden"
                                                                id="selected_subject_{{ $subject['name'] }}"
                                                                value="">
                                                            <h4>{{ $subject['name'] }} ({{ $subject['title'] }})</h4>
                                                            <h6>Please Choose {{ $subject['limit_subject'] }} Major
                                                                Subject.
                                                                <p class="text-danger-error"
                                                                    id="subject_error_{{ $subject['name'] }}"></p>
                                                            </h6>
                                                            <hr>
                                                            @foreach ($subject['sub_subjects'] as $key1 => $sub)
                                                                <div class="form-group" style="margin-bottom: 0">
                                                                    <input
                                                                        class="subject {{ $subject['name'] }}_code_{{ $sub['subject_code'] }} 
                                                                        status_{{ $subject['name'] }} 
                                                                        status_{{ $subject['name'] }}_{{ $key1 }} 
                                                                        main_{{ $sub['main_subject_id'] }}_status_{{ $subject['name'] }}"
                                                                        name="sub_subject[]" type="checkbox"
                                                                        value="{{ $sub['id'] }}"
                                                                        section="{{ $student->section_id }}"
                                                                        code="{{ $sub['subject_code'] }}"
                                                                        main-subject="{{ $sub['main_subject_id'] }}"
                                                                        subject-status="{{ $subject['name'] }}"
                                                                        id="subject_{{ $sub['id'] }}"
                                                                        subject-name="{{ $sub['name'] }}" multiple
                                                                        {{ $subject['name'] == 'Compulsory' ? 'checked' : '' }}>
                                                                    <label for="subject_{{ $sub['id'] }}">
                                                                        {{ $sub['name'] }} </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <input type="button" name="previous" class="previous action-button-previous"
                                            value="Previous" />
                                        <input type="button" name="make_payment" class="next action-button"
                                            value="Next Step" serial="3" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card form-page">
                                            {{-- <h2 class="fs-title text-center">Review Page !</h2> --}}
                                            <br>

                                            <div class="row ">
                                                <div class="col-md-3">
                                                    <img src="{{ asset('/') }}assets/front/images/logo1.png"
                                                        alt="your image" style="height: 200px;width: 200px;" />
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <h2 style="padding:0;">কুমিল্লা সরকারি কলেজ</h2>
                                                    <h3 style="padding:0;">Policeline, Comilla, Bangladesh.</h3>
                                                    <h4 style="padding:0;color:black">Phone: 081-65968, EIIN-
                                                        105824</h4>
                                                </div>
                                                <div class="col-3">
                                                    <img id="blah2"
                                                        src="{{ asset('/') }}assets/front/images/demo-profile.jpg"
                                                        alt="your image" style="height: 200px;width: 200px;" />
                                                </div>
                                            </div>
                                            <h3 style="text-align: center">Student Information</h3>
                                            <hr>
                                            <div class="row" style="padding:0;color:black;">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Full Name
                                                                <sup>*</sup></label>:
                                                        </div>
                                                        <div class="col-md-7"><strong
                                                                id="full_name">{{ $student->full_name }}</strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Student Id
                                                                <sup>*</sup></label>
                                                        </div>
                                                        <div class="col-md-7"><strong
                                                                id="student_id">{{ $student->student_id }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Class Roll
                                                                <sup>*</sup></label>
                                                        </div>
                                                        <div class="col-md-7"><strong
                                                                id="class_roll">{{ $student->class_roll }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">HSC Group
                                                                <sup>*</sup></label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <strong id="">{{ $student->section->name }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Session
                                                                <sup>*</sup></label></div>
                                                        <div class="col-md-7">
                                                            <strong id="">{{ $student->education_year }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Gender
                                                                <sup>*</sup></label></div>
                                                        <div class="col-md-7"><strong id="gender">{{ $student->gender}}</strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Religion
                                                                <sup>*</sup></label></div>
                                                        <div class="col-md-7"><strong id="religion"></strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Marital status
                                                            </label>
                                                        </div>
                                                        <div class="col-md-7"><strong
                                                                id="marital_status">Unmarried</strong></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">School Name
                                                                <sup>*</sup></label>
                                                        </div>
                                                        <div class="col-md-7"><strong id="school"><small
                                                                    class="text-danger">এই তথ্য প্রদান করা
                                                                    আবশ্যক।</small></strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">SSC Roll
                                                                <sup>*</sup></label></div>
                                                        <div class="col-md-7"><strong
                                                                id="ssc_roll">{{ $student->ssc_roll }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">SSC Registation No
                                                                <sup>*</sup></label></div>
                                                        <div class="col-md-7"><strong id="ssc_reg"><small
                                                                    class="text-danger">এই তথ্য প্রদান করা
                                                                    আবশ্যক।</small></strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Date of Birth
                                                                <sup>*</sup></label>
                                                        </div>
                                                        <div class="col-md-7"><strong id="dob"><small
                                                                    class="text-danger">এই তথ্য প্রদান করা
                                                                    আবশ্যক।</small></strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Nationality
                                                                <sup>*</sup></label>
                                                        </div>
                                                        <div class="col-md-7"><strong
                                                                id="nationality">Bangladeshi</strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">SSC GPA(without
                                                                4th) <sup>*</sup></label></div>
                                                        <div class="col-md-7"><strong id="ssc_gpa"><small
                                                                    class="text-danger">এই তথ্য প্রদান করা
                                                                    আবশ্যক।</small></strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">SSC GPA(with
                                                                4th) <sup>*</sup></label></div>
                                                        <div class="col-md-7"><strong id="ssc_gpa_forth"><small
                                                                    class="text-danger">এই তথ্য প্রদান করা
                                                                    আবশ্যক।</small></strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Phone Number
                                                                <sup>*</sup></label>
                                                        </div>
                                                        <div class="col-md-7"><strong id="phone"><small
                                                                    class="text-danger">এই তথ্য প্রদান করা
                                                                    আবশ্যক।</small></strong></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 style="text-align:center">Parents Information</h3>
                                            <hr>
                                            <div class="row" style="padding:0;color:black">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Father Name
                                                                <sup>*</sup></label>:
                                                        </div>
                                                        <div class="col-md-7"><strong id="father_name"><small
                                                                    class="text-danger">এই তথ্য প্রদান করা
                                                                    আবশ্যক।</small></strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Father NID </label>:
                                                        </div>
                                                        <div class="col-md-7"><strong id="father_nid"></strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Father
                                                                Occupation</label>:</div>
                                                        <div class="col-md-7"><strong id="father_occupation"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Father Yearly
                                                                Income</label>:</div>
                                                        <div class="col-md-7"><strong id="father_yearly_income"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Parents Phone
                                                                No <sup>*</sup></label>:</div>
                                                        <div class="col-md-7"><strong id="parents_phone"><small
                                                                    class="text-danger">এই তথ্য প্রদান করা
                                                                    আবশ্যক।</small></strong></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Mother Name</label>:
                                                        </div>
                                                        <div class="col-md-7"><strong id="mother_name"><small
                                                                    class="text-danger">এই তথ্য প্রদান করা
                                                                    আবশ্যক।</small></strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Mother NID</label>:
                                                        </div>
                                                        <div class="col-md-7"><strong id="mother_nid"></strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Mother
                                                                Occupation</label>:</div>
                                                        <div class="col-md-7"><strong id="mother_occupation"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Mother Yearly
                                                                Income</label>:</div>
                                                        <div class="col-md-7"><strong id="mother_yearly_income"></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 style="text-align:center">Address/Local Guardian</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Present
                                                                Address <sup>*</sup></label>:</div>
                                                        <div class="col-md-7"><strong id="present_address"></strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Permanent
                                                                Address <sup>*</sup></label>:</div>
                                                        <div class="col-md-7"><strong id="permanent_address"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Blood Group</label>:
                                                        </div>
                                                        <div class="col-md-7"><strong id="blood_group"></strong></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Local Guardian
                                                                Name</label>:</div>
                                                        <div class="col-md-7"><strong id="local_guardian_name"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Local Guardian
                                                                Mobile</label>:</div>
                                                        <div class="col-md-7"><strong id="local_guardian_mobile"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Relation with
                                                                Guardian</label>:</div>
                                                        <div class="col-md-7"><strong
                                                                id="relation_local_guardian"></strong></div>
                                                    </div>
                                                    <strong id="password" style="opacity: 0;"></strong>
                                                    <strong id="confirm_password" style="opacity: 0;"></strong>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row" style="color: black">
                                                <div class="col-md-4"
                                                    style="letter-spacing: -0.5px;padding:0px;line-height: 23px;">
                                                    <h4>Compulsory (আবশ্যিক) </h4>
                                                    <hr>
                                                    <div class="subject-list-class-compulsory"></div>
                                                </div>
                                                <div class="col-md-4"
                                                    style="letter-spacing: -0.5px;padding:0px;line-height: 23px;">
                                                    <h4>Elective (নৈর্বাচনিক)</h4>
                                                    <hr>
                                                    <div class="subject-list-class-Elective"></div>
                                                </div>
                                                <div class="col-md-4"
                                                    style="letter-spacing: -0.5px;padding:0px;line-height: 23px;">
                                                    <h4>4th (৪র্থ ঐচ্ছিক )</h4>
                                                    <hr>
                                                    <div class="subject-list-class-4th"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous"
                                            value="Previous" />
                                        <button id="submit_form" type="button"
                                            class="btn btn-success btn-lg">Save</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custome-js')
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
                blah2.src = URL.createObjectURL(file)
                $('#file_error').val(1);
            }
        }
    </script>
@endsection
