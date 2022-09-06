@extends('layouts.front.master')
@section('title', 'Login Page')
@section('custome-css')
@endsection
@section('content')
    <!-- CONTACT -->
    <div class="container">
        <section class="registration" id="contact">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <form id="contact-form" role="form" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="section-title">
                            <h2>Login Students <small>Login with your SSC Roll and password!</small></h2>
                            @include('_message')
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="username">SSC Roll <small>(Login Id)</small></label>
                                <input id="email" type="number"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <input type="submit" class="form-control" name="send message" value="Login">
                        </div>

                    </form>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="contact-image">
                        <img src="{{ asset('/') }}assets/front/images/loginCover.jpg" class="img-responsive"
                            alt="Login Image" width="95%">
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
