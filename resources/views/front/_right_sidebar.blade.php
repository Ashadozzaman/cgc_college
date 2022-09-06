<div class="col-md-3" style="padding: 0;">
    <div class="principale_topbar ">
        <div class="item">
            <div class="item-header">
                <div class="item-header-logo">
                    <!-- <img src="{{ asset('/') }}assets/front/images/logogov.png" alt="" width="17%"> -->
                    <h4>Education Minister</h4>
                </div>
            </div>

            <div class="principle-image">
                <img src="{{ asset('/') }}assets/front/images/edu_minister.jpg" width="100%">
                <p><b>Dr Dipu Moni</b></p>
                <!-- <hr> -->
                {{-- <a href="">Continue Reading ...</a> --}}
            </div>
        </div>
    </div>
    <br>
    <div class="principale_topbar ">
        <div class="item">
            <div class="item-header">
                <div class="item-header-logo">
                    <!-- <img src="{{ asset('/') }}assets/front/images/logogov.png" alt="" width="17%"> -->
                    <h4>Message of the Principal</h4>
                </div>
            </div>
            <div class="principle-image">
                <img src="{{ asset('/') }}assets/front/images/principle_image.jpg" width="100%">
                <!-- <p><b>প্রফেসর মোঃ বাহাদুর হোসেন</b></p> -->
                <p><b>Professor Md. Bahadur Hossain</b></p>
                <!-- <hr> -->
                <a href="{{ route('principal.message') }}">Continue Reading ...</a>
            </div>
        </div>
    </div>
    <br>
    <div class="principale_topbar ">
        <div class="item">
            <div class="item-header">
                <div class="item-header-logo">
                    <h4>কলেজ সম্পর্কিত তথ্য</h4>
                </div>
            </div>
            <ul class="important_link_ul">
                <li>
                    <i class="text-green fa fa-users"></i>
                    <a href="{{ route('faculty') }}">FACULTY MEMBERS</a>
                </li>
                <hr>
                <li>
                    <i class="text-green fa fa-user"></i>
                    <a href="{{ route('office_staffs') }}"> COLLEGE STAFF</a>
                </li>
                <hr>
                <li>
                    <i class="text-green fa fa-info-circle"></i>
                    <a href="{{ route('information', 'admission') }}"> ADMISSION INFORMATION</a>
                </li>
                <hr>
                <li>
                    <i class="text-green fa fa-calendar"></i>
                    <a href="{{ route('information', 'academic') }}">ACADEMIC CALENDAR</a>
                </li>
                <hr>
                <li>
                    <i class="text-green fa fa-users"></i>
                    <a href="{{ route('information', 'syllabus') }}">SYLLABUS</a>
                </li>
                <hr>
                <li>
                    <i class="text-green fa fa-clock-o"></i>
                    <a href="{{ route('information', 'routine') }}">ROUTINE</a>
                </li>
                <hr>
                <li>
                    <i class="text-green fa fa-list-alt"></i>
                    <a href="">EXAM RESULTS</a>

                    <ul class="">
                        <hr>
                        <li><i class="text-green fa fa-arrow-right"></i> <a
                                href="{{ route('information', 'internal') }}">Internal Exam Result</a></li>
                        <hr>
                        <li><i class="text-green fa fa-arrow-right"></i> <a
                                href="{{ route('information', 'public') }}">Public Exam Result</a></li>
                    </ul>
                </li>
                <hr>
                <li>
                    <i class="text-green fa fa-picture-o"></i>
                    <a href="{{route('image.gallery')}}">IMAGE GALLERY</a>
                </li>
            </ul>
        </div>
    </div>
    <br>
    <div class="principale_topbar ">
        <div class="item">
            <div class="item-header">
                <div class="item-header-logo">
                    <h4>গুরুত্বপূর্ণ লিংক</h4>
                </div>
            </div>
            <ul class="important_link_ul">
                @foreach ($important_links as $val)
                    <li><i class="text-green fa fa-caret-right"></i> <a href="{{ $val->link }}"
                            target="_blank">{{ $val->title }}</a></li>
                    <hr>
                @endforeach
            </ul>
        </div>
    </div>
</div>
