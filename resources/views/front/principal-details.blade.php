@extends('layouts.front.master')
@section('title', 'Principle Message')
@section('custome-css')
@endsection
@section('content')
    <div class="container">
        <div class="row" style="padding: 20px 0 0 7px;">
            <div class="col-md-9" style="margin-top: -18px;">
                <div class="title">
                    <h3>Principle <small>(Cumilla Govt. College)</small></h3>
                </div><br>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="department-team">
                            <div class="team-image">
                                <img src="{{ asset('/') }}assets/front/images/principle_image.jpg" class="img-responsive"
                                    alt="" style="height: 220px">
                            </div>
                            <div class="team-info">
                                <h4>Professor Md. Bahadur Hossain</h4>
                                <span>Principal</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-4">
                        <p>
                            আমি খুবই আনন্দিতে এটা জেনে যে, আমাদের প্রতিষ্ঠানে একটি ডায়নামিক ওয়েবসাইট চালু আছে। এটা হলো
                            প্রযুক্তিগত উন্নয়নের যুগ। এই যান্ত্রিক সভ্যতায় আমার মনে হয় একটি দিনও আমরা বিজ্ঞানের সাহায্য ছাড়া
                            চলতে পারি না। তাই সময়ের দাবী মেটাতে ডায়নামিক ওয়েবসাইটের কোন বিকল্প নেই। ডায়নামিক ওয়েবসাইটের
                            মাধ্যমে আমরা কলেজের বিভিন্ন বিষয়ে তাৎক্ষণিক সিদ্ধান্ত ও প্রাসঙ্গিক বিষয়াবলীর হালনাগাদ তথ্য জানতে
                            পারছি। এ ওয়েবসাইটে আমাদের কলেজ প্রতিষ্ঠার ইতিহাস থেকে শুরু করে প্রত্যেক শিক্ষক, কর্মচারী ও
                            শিক্ষার্থী সকলের বিস্তারিত তথ্য আছে। কলেজের দৈনন্দিন কর্মকান্ড বিশেষ করে শিক্ষার্থী সংশ্লিষ্ট
                            বিভিন্ন বিজ্ঞপ্তি ও তাদের পরীক্ষার ফলাফল ইত্যাদি বিষয়ে তথ্য প্রকাশিত হয়ে থাকে। মাননীয়
                            প্রধানমন্ত্রীর যে ভিশন দুহাজার একুশ সালের মধ্যে দেশকে একটি মধ্যম আয়ের দেশ হিসেবে গড়ে তোলা এবং
                            সর্বোপরি ডিজিটাল বাংলাদেশ গড়ে তোলা এ দৃষ্টিকোণকে আমরা স্বাগত জানাই এবং একাত্বতা ঘোষণা করে
                            প্রযুক্তিগত উন্নয়নের মধ্য দিয়েই আমরাও আমাদের প্রতিষ্ঠানটিকে উন্নয়নের লক্ষ্যে এগিয়ে নিতে চাই।
                        </p>
                    </div>
                </div>

            </div>
            @include('front._right_sidebar')
        </div>
    </div>
@endsection
