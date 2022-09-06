@extends('layouts.front.master')
@section('title', 'Home Page')
@section('custome-css')
@endsection
@section('content')
    <!-- CONTACT -->
    <section class="registration" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form id="contact-form" role="form" action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="section-title">
                            <h2>Student Registration <small>Please enter your valid info!</small></h2>
                            @include('_message')
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Full Name <sup><b>*</b></sup></label>
                                <input type="text" class="form-control" placeholder="Enter first name" name="first_name"
                                    value="{{ old('first_name') }}" required="">
                                @error('first_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Last Name<sup><b>*</b></sup></label>
                                <input type="text" class="form-control" placeholder="Enter last name" name="last_name"
                                    value="{{ old('last_name') }}" required="">
                                @error('last_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Father Name<sup><b>*</b></sup></label>
                                <input type="text" class="form-control" placeholder="Enter father name"
                                    name="father_name" value="{{ old('father_name') }}" required="">
                                @error('father_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="">Email<sup></sup></label>
                                <input type="email" class="form-control" placeholder="Enter email address" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">SSC Roll<sup>*</sup></label>
                                <input type="number" class="form-control" placeholder="Enter ssc roll" name="ssc_roll"
                                    value="{{ old('ssc_roll') }}" required="">
                                @error('ssc_roll')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Registration No.<sup>*</sup></label>
                                <input type="number" class="form-control" placeholder="Enter registation number"
                                    name="reg_num" value="{{ old('reg_num') }}" required="">
                                @error('reg_num')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="">Section<sup>*</sup></label>
                                <select name="section_id" id="" class="form-control" required>
                                    <option value="">Select Section</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="">Education Year<sup>*</sup></label>
                                <select name="education_year" id="" class="form-control" required>
                                    <option value="">Select Section</option>
                                    {{ $start = 2010 }}
                                    {{ $last = 2050 }}
                                    @for ($i = $start; $i <= $last; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('education_year')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Phone Number<sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="Enter phone number" name="phone"
                                    value="{{ old('phone') }}" required="">
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Profile Image<sup>*</sup></label>
                                <input type="file" class="form-control" name="image">
                                @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="">Password<sup><b>*</b></sup></label>
                                <input type="password" class="form-control" placeholder="Enter password " name="password"
                                    required="">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Password Confirmation<sup><b>*</b></sup></label>
                                <input type="password" class="form-control" placeholder="Enter confirm password"
                                    name="password_confirmation" required="">
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            {{-- <button class="form-control btn btn-info">Register</button> --}}
                            <input type="submit" class="form-control" name="submit" value="Register">
                        </div>

                    </form>
                </div>
                {{-- <div class="col-md-6 col-sm-12">
                <div class="contact-image">
                    <img src="{{asset('/')}}assets/front/images/contact-image.jpg" class="img-responsive" alt="Smiling Two Girls" width="90%">
                </div>
            </div> --}}
            </div>
        </div>
    </section>
@endsection
