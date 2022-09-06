@extends('layouts.admin.master')
@section('title', 'Principal About Us Page')
@section('custome-css')
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Principal About Us Page</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Principal About Us Page</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Principal About Us Page</h4>
                    <p class="card-title-desc">Principal About Us Page here....!</p>
                    @include('_message')
                    <form action="{{route('admin.about_us.submit')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input name="id" type="hidden" value="2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" id="about_principal" required>{{ old('description',$about_us->description) }}</textarea>
                                    @error('description')
                                        <p class="text-danger"></p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <!-- end row -->
@endsection


@section('custome-js')
    <!--tinymce js-->
    <script src="{{ asset('/') }}assets/admin/libs/tinymce/tinymce.min.js"></script>

    <!-- Summernote js -->
    <script src="{{ asset('/') }}assets/admin/libs/summernote/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea#about_principal",
            height: 600,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor",
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [{
                    title: "Bold text",
                    inline: "b"
                },
                {
                    title: "Red text",
                    inline: "span",
                    styles: {
                        color: "#ff0000"
                    },
                },
                {
                    title: "Red header",
                    block: "h1",
                    styles: {
                        color: "#ff0000"
                    },
                },
                {
                    title: "Example 1",
                    inline: "span",
                    classes: "example1"
                },
                {
                    title: "Example 2",
                    inline: "span",
                    classes: "example2"
                },
                {
                    title: "Table styles"
                },
                {
                    title: "Table row 1",
                    selector: "tr",
                    classes: "tablerow1"
                },
            ],
        });
    </script>
    <!-- init js -->
    <script src="{{ asset('/') }}assets/admin/js/pages/form-editor.init.js"></script>
    <!-- end row -->
@endsection
