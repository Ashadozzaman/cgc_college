<!-- PRE LOADER -->
<section class="preloader">
    <div class="spinner">
        <span class="spinner-rotate"></span>
    </div>
</section>
<div class="container">
    <!-- HOME -->
    <section id="home">
        <div class="banners">
            <img class="logo" src="{{ asset('/') }}assets/front/images/cgclogo.png">
            <div class="row">
                <div class="slider">
                    <div class="owl-carousel owl-theme home-slider">
                        @foreach ($banners as $banner)
                            <div class="item itemfirst">
                                <img src="{{ asset('/') }}assets/admin/images/banner/{{ $banner->image }}">
                                <div class="caption">
                                    <div class="container">
                                        <div class="col-md-6 col-sm-12">
                                            <h1>Comilla Govt. College</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- MENU -->
    <!-- <section class="navbar custom-navbar navbar-fixed-top" role="navigation"> -->
    <section class="navbar" role="navigation" style="z-index: 1 !important;">
        <div class="custom-navbar-change">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

            </div>
            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-nav-first">
                    <li><a href="{{ url('/') }}" class="smoothScroll">Home</a></li>
                    <li><a href="{{route('faculty')}}" class="smoothScroll">Our Faculty</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">Departments <span class="caret"></span></a>
                        <ul class="dropdown-menu logout-dropdown">
                            @foreach ($departments as $department)
                                <li><a
                                        href="{{ route('department.details', $department->id) }}">{{ $department->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{route('contact')}}" class="smoothScroll">Contact</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
                        <ul class="dropdown-menu logout-dropdown">
                            <li><a href="{{ route('about') }}" class="smoothScroll">About</a></li>
                            <li><a href="{{ route('about.principal') }}" class="smoothScroll">About Principal</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">Student <span class="caret"></span></a>
                        <ul class="dropdown-menu logout-dropdown">
                            @if (Route::has('login'))
                                @auth
                                    <li><a href="{{ route('user.profile') }}">Profile</a></li>
                                    <li><a href="{{ route('get.result.history',auth()->user()->student_id) }}">Result</a></li>
                                    <li role="separator" class="divider"></li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-none text-center logout">
                                        @csrf
                                        <button class="btn">Logout</button>
                                    </form>
                                @else
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    @if (Route::has('register'))
                                        <li><a href="{{ route('student.register') }}">Register</a></li>
                                    @endif
                                    <li role="separator" class="divider"></li>
                                @endauth
                            @endif
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                       <li><a href="#"><i class="fa fa-phone"></i>  +081-65968</a></li>
                  </ul> 
            </div>

        </div>
    </section>

</div>
