@extends('layouts.front.master')
@section('title', 'Contact Page')
@section('custome-css')
@endsection
@section('content')
    <!-- CONTACT -->
    <div class="container">
        @include('_message')
        <section class="registration" id="contact">
            <div class="row">
                <div class="col-md-6">

                    <form id="contact-form" role="form" action="{{route('submit.contact')}}" method="post">
                        @csrf
                        <div class="section-title">
                            <h2>Contact us <small>we love conversations. let us talk!</small></h2>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <select name="user_type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="Parent">Parent</option>
                                <option value="Student">Student</option>
                                <option value="Others">Others</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Enter full name" name="name"
                                required="">
                            <input type="text" class="form-control" placeholder="Enter phone number" name="phone"
                                required="">
                            <input type="email" class="form-control" placeholder="Enter email address" name="email"
                                >

                            <textarea class="form-control" rows="6" placeholder="Tell us about your message" name="message" required=""></textarea>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <input type="submit" class="form-control" name="submit" value="Send Message">
                        </div>

                    </form>
                </div>
                <div class="col-md-6" style="padding-top: 10%;">
                    <div class="contact-image">
                        <img src="{{ asset('/') }}assets/front/images/contact.jpeg" class="img-responsive"
                            alt="Smiling Two Girls">
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
