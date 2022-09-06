@extends('layouts.front.master')
@section('title', 'Home Page')
@section('custome-css')
    <style>

    </style>
@endsection
@section('content')

    <!-- TESTIMONIAL -->
    <div class="container">
        <section id="testimonial">
            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <div class="owl-carousel owl-theme owl-client">
                        @foreach ($images as $image)
                            <div class="col-md-4">
                                <div class="courses-image ">
                                    <img src="{{ asset('/') }}assets/admin/images/gallery/{{ $image->image }}"
                                        class="img-responsive sourceImage pop" alt=""
                                        style="width: 100%; height: 264px;">
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
        </section>
    </div>
    <!-- TESTIMONIAL -->
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h3> Gallery <small>Cumilla Govt. College</small></h3>
            </div>
        </div>
        <hr>
        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-3">
                    <div class="courses-image ">
                        <img src="{{ asset('/') }}assets/admin/images/gallery/{{ $image->image }}"
                            class="img-responsive sourceImage pop" alt="" style="width: 100%; height: 264px;">
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
        <div class="card-footer text-center" style="font-weight: bold;">
            {{ $images->links() }}
        </div>
    </div>
    <!-- Creates the bootstrap modal where the image will appear -->
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    {{-- <h4 class="modal-title" id="myModalLabel">Image preview</h4> --}}
                </div>
                <div class="modal-body text-center">
                    <a href="#" id="image-link" target="_blank"><img src="" id="imagepreview" style="max-width: 100%;"></a>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
@section('custome-js')
    <script>
        $(".pop").on("click", function() {
            $("#imagepreview").attr('src', $(this).attr('src'));
            $("#image-link").attr('href', $(this).attr('src'));
            $('#imagemodal').modal(
                'show'
            ); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
        });
    </script>
@endsection
