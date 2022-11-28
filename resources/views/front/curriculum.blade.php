@extends('layouts.front.master')
@section('title', 'About Us Page')
@section('custome-css')
@endsection
@section('content')
@if ($curriculum)
    <div class="container">
        <div class="row" style="padding: 0px 20px">
            <div class="title">
                <h3>{{ $curriculum->title }}</h3>
            </div>
            <br>
            <div class="col-md-12 col-sm-12" style="z-index: 0;">
                <div class="owl-carousel owl-theme owl-courses">
                    @foreach ($curriculum->curriculum_images as $curriculum_image)
                        <img src="{{ asset('/') }}assets/admin/images/curriculums/images/{{ $curriculum_image->image }}"
                            class="img-responsive" alt="" style="max-height:250px">
                    @endforeach
                </div>
            </div>
            <br>
            <div style="padding: 0px 20px;overflow: hidden;">
                <p>{!! $curriculum->details !!} </p>
            </div>
        </div>
        <div class="row" style="padding: 0px 20px">
            <div class="col-md-8">
                <div id="notice-section">
                    <div class="card">
                        <div class="card-header">
                            <h3>All Related Event Data </h3>
                        </div>
                        <hr>
                        <div class="card-body">
                            <ul>
                                @foreach ($curriculums as $item)
                                    <li><i class="text-green fa fa-caret-right"></i> <a
                                            href="{{ route('co.curriculum',[$item->curriculum_id,$item->id]) }}">{{ $item->title }} ({{ $item->published_date }}) </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card_footer">
                            {{ $curriculums->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @if($curriculum->file)
                <div class="file">
                    <div>
                        <object data="{{ asset('assets/admin/images/curriculums/pdf/') }}/{{ $curriculum->file }}"
                            type="application/pdf" width="100%">
                        </object>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@else
<div class="container">
    <div class="row" style="padding: 0px 20px">
        <h3>There is no item here...</h3>
    </div>
</div>
@endif

@endsection
