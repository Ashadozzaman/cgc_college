@extends('layouts.admin.master')
@section('title','Co-Curriculum') 
@section('custome-css')
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Co-Curriculums Add</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Add Co-Curriculums</li>
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
                <h4 class="card-title">Add Co-Curriculums</h4>
                <p class="card-title-desc">Create Co-Curriculums here....!</p>
                <form action="{{route('co_curriculum.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label>Co-Curriculum Title<sup>*</sup></label>
                                <input class="form-control" name="title"  type="text" placeholder="Enter title" value="{{old('title')}}" required>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Curriculums<sup>*</sup></label>
                                <select name="curriculum_id" class="form-control" required>
                                    <option value="0">Select Curriculum</option>
                                    @foreach($curriculums as $curriculum)
                                        <option value="{{$curriculum->id}}">{{$curriculum->name}}</option>
                                    @endforeach
                                </select>
                                @error('curriculum_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Published Date<sup>*</sup></label>
                                <input class="form-control" name="published_date"  type="date" placeholder="published date" value="{{old('published_date')}}" required>
                                @error('published_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>Image <small>(If you want upload multiple image)</small></label>
                                <input type="file" name="images[]" class="form-control" accept=".jpeg,.png,.jpg" multiple>
                                @error('images')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label>File <small>(Please Upload only pdf)</small></label>
                                <input type="file" name="file" class="form-control" accept=".pdf">
                                @error('file')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label>Details</label>
                                <textarea name="details" class="form-control" id="co_curriculum_details">{{old('details')}}</textarea>
                                @error('details')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                    
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
<script src="{{asset('/')}}assets/admin/libs/tinymce/tinymce.min.js"></script>

<!-- Summernote js -->
<script src="{{asset('/')}}assets/admin/libs/summernote/summernote-bs4.min.js"></script>

<script type="text/javascript">
    tinymce.init({
        selector: "textarea#co_curriculum_details",
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
<!-- end row -->
@endsection