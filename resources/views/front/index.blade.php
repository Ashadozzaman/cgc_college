@extends('layouts.front.master')
@section('title', 'Home Page')
@section('custome-css')
    <style>

    </style>
@endsection
@section('content')

    <!-- FEATURE -->
    <section id="feature">
        <div class="container">
            <div class="row">
                <!-- left side start -->
                <div class="col-md-9">
                    <div class="banner">
                        <div class="central-banner">
                            <img src="{{ asset('/') }}assets/front/images/padmabanner.jpeg" alt="central banner"
                                width="100%">
                        </div>
                    </div>
                    <div id="notice-section">
                        <div class="card">
                            <div class="card-header">
                                <h3>Notice</h3>
                            </div>
                            <hr>
                            <div class="card-body">
                                <ul>
                                    @foreach ($notices as $item)
                                        <li><i class="text-green fa fa-caret-right"></i> <a
                                                href="{{ route('notice.details', $item->id) }}">{{ $item->title }} </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card_footer">
                                {{ $notices->links() }}
                            </div>
                        </div>
                    </div>

                    <div id="service-section">
                        <div class="card">
                            <div class="card-header">
                                <h3>আমাদের সেবা</h3>
                            </div>
                        </div>
                    </div>
                    <div id="service">
                        <div class="row">
                            @foreach ($services as $item)
                                <div class="col-md-6" >
                                    <div class="item">
                                        <div class="tst-author">
                                            <h4>{{ $item->title }}</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="tst-image">
                                                    <img src="{{ asset('/') }}assets/admin/images/service/{{ $item->image }}"
                                                        class="img-responsive" alt="">
                                                </div>

                                            </div>
                                            <div class="col-md-8">
                                                <ul  style="padding: 0px;">
                                                    @foreach ($item->service_categories as $val)
                                                        <li><i class="text-green fa fa-caret-right"></i> <a
                                                                href="{{route('service.details',$val->id)}}">{{ $val->title }}</a></li>
                                                    @endforeach
                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="service-section">
                        <div class="card">
                            <div class="card-header">
                                <h3>DEPARTMENTS OF CGC <small>Cumilla Govt. College</small></h3>
                            </div>
                        </div>
                    </div>
                    <!-- department -->
                    <section id="courses">
                        <div class="row">

                            <div class="col-md-12 col-sm-12">
                                <div class="owl-carousel owl-theme owl-courses">
                                    @foreach ($departments as $department)
                                        <div class="col-md-4 col-sm-4">
                                            <div class="item">
                                                <div class="courses-thumb">
                                                    <div class="courses-top">
                                                        <div class="courses-image">
                                                            <img src="{{ asset('/') }}assets/admin/images/department/{{ $department->image }}"
                                                                class="img-responsive" alt="">
                                                        </div>
                                                        <div class="courses-date">
                                                            <span></span>
                                                        </div>
                                                    </div>

                                                    <div class="courses-detail">
                                                        <h3><a href="{{ route('department.details', $department->id) }}">{{ $department->title }}</a></h3>
                                                        <p>{{ Str::limit($department->body, 50) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                    </section>

                    <div id="service-section">
                        <div class="card">
                            <div class="card-header">
                                <h3> Our Teachers<small>Cumilla Govt. College</small></h3>
                            </div>
                        </div>
                    </div>
                    <!-- TEAM -->
                    <section id="courses">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="owl-carousel owl-theme owl-courses">
                                    @foreach ($teachers as $teacher)
                                        <div class="col-md-4 col-sm-4">
                                            <div class="team-thumb">
                                                <div class="team-image">
                                                    @if ($teacher->image)
                                                        <img src="{{ asset('/') }}assets/admin/images/employee/{{ $teacher->image }}"
                                                            class="img-responsive" alt="" style="height: 220px">
                                                    @else
                                                        <img src="{{ asset('/') }}assets/front/images/demo-profile.jpg"
                                                            class="img-responsive" alt="" style="height: 220px">
                                                    @endif
                                                </div>
                                                <div class="team-info">
                                                    <h3>{{ $teacher->name }}</h3>
                                                    <span>{{$teacher->designation->title}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                    </section>

                </div>
                <!-- left side end -->

                <!-- right side start -->
                @include('front._right_sidebar')
                <!-- left side end -->
            </div>
        </div>
    </section>


    {{-- <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <div class="row">
                <!-- left side start -->
                <div class="col-md-6 col-sm-12">
                    <div class="about-info">
                        <h2>Start your journey to a better life with online practical courses</h2>

                        <figure>
                            <span><i class="fa fa-users"></i></span>
                            <figcaption>
                                <h3>Professional Trainers</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ipsa voluptatibus.</p>
                            </figcaption>
                        </figure>

                        <figure>
                            <span><i class="fa fa-certificate"></i></span>
                            <figcaption>
                                <h3>International Certifications</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ipsa voluptatibus.</p>
                            </figcaption>
                        </figure>

                        <figure>
                            <span><i class="fa fa-bar-chart-o"></i></span>
                            <figcaption>
                                <h3>Free for 3 months</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ipsa voluptatibus.</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>

                <div class="col-md-offset-1 col-md-4 col-sm-12">
                    <div class="entry-form">
                        <form action="#" method="post">
                            <h2>Signup today</h2>
                            <input type="text" name="full name" class="form-control" placeholder="Full name"
                                required="">

                            <input type="email" name="email" class="form-control" placeholder="Your email address"
                                required="">

                            <input type="password" name="password" class="form-control" placeholder="Your password"
                                required="">

                            <button class="submit-btn form-control" id="form-submit">Get started</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- TEAM -->
    <section id="team">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <div class="section-title">
                        <h2>Teachers <small>Meet Professional Trainers</small></h2>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="team-thumb">
                        <div class="team-image">
                            <img src="{{ asset('/') }}assets/front/images/author-image1.jpg" class="img-responsive"
                                alt="">
                        </div>
                        <div class="team-info">
                            <h3>Mark Wilson</h3>
                            <span>I love Teaching</span>
                        </div>
                        <ul class="social-icon">
                            <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-instagram"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="team-thumb">
                        <div class="team-image">
                            <img src="{{ asset('/') }}assets/front/images/author-image2.jpg" class="img-responsive"
                                alt="">
                        </div>
                        <div class="team-info">
                            <h3>Catherine</h3>
                            <span>Education is the key!</span>
                        </div>
                        <ul class="social-icon">
                            <li><a href="#" class="fa fa-google"></a></li>
                            <li><a href="#" class="fa fa-instagram"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="team-thumb">
                        <div class="team-image">
                            <img src="{{ asset('/') }}assets/front/images/author-image3.jpg" class="img-responsive"
                                alt="">
                        </div>
                        <div class="team-info">
                            <h3>Jessie Ca</h3>
                            <span>I like Online Courses</span>
                        </div>
                        <ul class="social-icon">
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-envelope-o"></a></li>
                            <li><a href="#" class="fa fa-linkedin"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="team-thumb">
                        <div class="team-image">
                            <img src="{{ asset('/') }}assets/front/images/author-image4.jpg" class="img-responsive"
                                alt="">
                        </div>
                        <div class="team-info">
                            <h3>Andrew Berti</h3>
                            <span>Learning is fun</span>
                        </div>
                        <ul class="social-icon">
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-google"></a></li>
                            <li><a href="#" class="fa fa-behance"></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>





    <!-- TESTIMONIAL -->
    <section id="testimonial">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <div class="section-title">
                        <h2>Student Reviews <small>from around the world</small></h2>
                    </div>

                    <div class="owl-carousel owl-theme owl-client">
                        <div class="col-md-4 col-sm-4">
                            <div class="item">
                                <div class="tst-image">
                                    <img src="{{ asset('/') }}assets/front/images/tst-image1.jpg"
                                        class="img-responsive" alt="">
                                </div>
                                <div class="tst-author">
                                    <h4>Jackson</h4>
                                    <span>Shopify Developer</span>
                                </div>
                                <p>You really do help young creative minds to get quality education and professional job
                                    search assistance. I’d recommend it to everyone!</p>
                                <div class="tst-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="item">
                                <div class="tst-image">
                                    <img src="{{ asset('/') }}assets/front/images/tst-image2.jpg"
                                        class="img-responsive" alt="">
                                </div>
                                <div class="tst-author">
                                    <h4>Camila</h4>
                                    <span>Marketing Manager</span>
                                </div>
                                <p>Trying something new is exciting! Thanks for the amazing law course and the great teacher
                                    who was able to make it interesting.</p>
                                <div class="tst-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="item">
                                <div class="tst-image">
                                    <img src="{{ asset('/') }}assets/front/images/tst-image3.jpg"
                                        class="img-responsive" alt="">
                                </div>
                                <div class="tst-author">
                                    <h4>Barbie</h4>
                                    <span>Art Director</span>
                                </div>
                                <p>Donec erat libero, blandit vitae arcu eu, lacinia placerat justo. Sed sollicitudin quis
                                    felis vitae hendrerit.</p>
                                <div class="tst-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="item">
                                <div class="tst-image">
                                    <img src="{{ asset('/') }}assets/front/images/tst-image4.jpg"
                                        class="img-responsive" alt="">
                                </div>
                                <div class="tst-author">
                                    <h4>Andrio</h4>
                                    <span>Web Developer</span>
                                </div>
                                <p>Nam eget mi eu ante faucibus viverra nec sed magna. Vivamus viverra sapien ex, elementum
                                    varius ex sagittis vel.</p>
                                <div class="tst-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
    </section>


    <!-- CONTACT -->
    <section id="contact">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-12">
                    <form id="contact-form" role="form" action="" method="post">
                        <div class="section-title">
                            <h2>Contact us <small>we love conversations. let us talk!</small></h2>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <input type="text" class="form-control" placeholder="Enter full name" name="name"
                                required="">

                            <input type="email" class="form-control" placeholder="Enter email address" name="email"
                                required="">

                            <textarea class="form-control" rows="6" placeholder="Tell us about your message" name="message"
                                required=""></textarea>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <input type="submit" class="form-control" name="send message" value="Send Message">
                        </div>

                    </form>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="contact-image">
                        <img src="{{ asset('/') }}assets/front/images/contact-image.jpg" class="img-responsive"
                            alt="Smiling Two Girls">
                    </div>
                </div>

            </div>
        </div>
    </section> --}}
@endsection
