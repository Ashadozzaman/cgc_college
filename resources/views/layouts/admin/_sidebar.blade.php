<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{asset('/')}}assets/admin/images/users/avatar-2.jpg" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark font-weight-medium font-size-16">{{auth()->user()->name}}</a>
                <p class="text-body mt-1 mb-0 font-size-13">{{auth()->user()->name}}</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="mdi mdi-airplay"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>Dashboard</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-human-male-female"></i>
                        <span>Student</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('get.students')}}">Students</a></li>
                        <li><a href="{{route('student.index')}}">Students Add</a></li>
                        <li><a href="{{route('students.card.generate')}}">Generate Card</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-pencil-minus"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>Exam Setting</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('create_exam.index')}}"> Create Exam</a></li>
                        <li><a href="{{route('mark_setup.index')}}"> Mark Setup </a></li>
                        <li><a href="{{route('get.result')}}"> Result </a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('section.index')}}" class=" waves-effect">
                        <i class="mdi mdi-vector-intersection"></i>
                        <span>Create Section</span>
                    </a>
                </li>


                <li>
                    <a href="{{route('department.index')}}" class=" waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Departments</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('designation.index')}}" class=" waves-effect">
                        <i class="mdi-shield-account-outline"></i>
                        <span>Designations</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('employee.index')}}" class=" waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Teacher</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('staff.index')}}" class=" waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Staff</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('teacher_assign.index')}}" class=" waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Assign Teacher</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-information"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>Academic Info</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('academic_calendar.index')}}">Academic Calender</a></li>
                        <li><a href="{{route('admission_information.index')}}">Adminssion Information</a></li>
                        <li><a href="{{route('notice.index')}}">Notices</a></li>
                        <li><a href="{{route('routine.index')}}">Routine</a></li>
                        <li><a href="{{route('syllabus.index')}}">Syllabus</a></li>
                        <li><a href="{{route('result.index')}}">Result</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-google-circles-group"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>Services</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('service.index')}}">Services</a></li>
                        <li><a href="{{route('service_category.index')}}">Service Category</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-settings"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>Setting</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('banner.index')}}">Banner</a></li>
                        <li><a href="{{route('gallery.index')}}">Gallery</a></li>
                        <li><a href="{{route('media.index')}}">Media</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('subject.index')}}" class=" waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Subject</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('important_link.index')}}" class=" waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Important Link</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-settings"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>About</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.about_us')}}">About Us</a></li>
                        <li><a href="{{route('admin.principal_us')}}">About Principal </a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.message.list')}}" class=" waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Message</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>