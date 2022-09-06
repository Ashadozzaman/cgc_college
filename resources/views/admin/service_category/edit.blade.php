@extends('layouts.admin.master')
@section('title', 'Service Category Edit')
@section('custome-css')
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Service Category Update</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Add Service Category</li>
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
                    <h4 class="card-title">Update Service Category</h4>
                    <p class="card-title-desc">Update Service Category here....!</p>
                    <form action="{{ route('service_category.update', $service_category->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Service Category Title<sup>*</sup></label>
                                        <input class="form-control" name="title" type="text" placeholder="Enter title"
                                            value="{{ old('title', $service_category->title) }}" required>
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Service<sup>*</sup></label>
                                        <select name="service_id" class="form-control" required>
                                            <option value="0"
                                                {{ $service_category->designation_id == 0 ? 'selected' : '' }}>Central
                                            </option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}"
                                                    {{ $service->id == $service_category->service_id ? 'selected' : '' }}>
                                                    {{ $service->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('service_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>File</label>
                                        <input type="file" name="file" class="form-control">
                                        @error('file')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        @if (isset($service_category->image))
                                            <img src="{{ asset('assets/admin/images/service_category') }}/{{ $service_category->image }}"
                                                alt="service_category image" width="40%">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Order By</label>
                                        <input class="form-control" name="order_by" type="number"
                                            value="{{ old('order_by', $service_category->order_by) }}" min="1"
                                            required>
                                        @error('order_by')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label>Details</label>
                                        <textarea name="body" class="form-control" id="service_body_edit">{{ old('body', $service_category->body) }}</textarea>
                                        @error('body')
                                            <p class="text-danger">{{ $message }}</p>
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
            selector: "textarea#service_body_edit",
            height: 300,
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
