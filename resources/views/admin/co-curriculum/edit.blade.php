@extends('layouts.admin.master')
@section('title', 'Co-Curriculum')
@section('custome-css')
    <style>
        .close-button {
            position: absolute;
            right: 24px;
            font-weight: bold;
            border-radius: 25px;
        }
    </style>
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Co-Curriculums Edit</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Edit Co-Curriculums</li>
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
                    <h4 class="card-title">Edit Co-Curriculums</h4>
                    <p class="card-title-desc">Edit Co-Curriculums here....!</p>
                    <form action="{{ route('co_curriculum.update', $co_curriculum->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label>Co-Curriculum Title<sup>*</sup></label>
                                    <input class="form-control" name="title" type="text" placeholder="Enter title"
                                        value="{{ old('title', $co_curriculum->title) }}" required>
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
                                        @foreach ($curriculums as $curriculum)
                                            <option value="{{ $curriculum->id }}"
                                                {{ $curriculum->id == $co_curriculum->curriculum_id ? 'selected' : '' }}>
                                                {{ $curriculum->name }}</option>
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
                                    <input class="form-control" name="published_date" type="date"
                                        placeholder="published date"
                                        value="{{ old('published_date', $co_curriculum->published_date) }}" required>
                                    @error('published_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label>Image <small>(If you want upload multiple image)</small></label>
                                    <input type="file" name="images[]" class="form-control" accept=".jpeg,.png,.jpg"
                                        multiple>
                                    @error('images')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row">
                                    @foreach ($curriculum_images as $item)
                                        <div class="col-md-2" style="position: relative;">
                                            <button type="button" class="btn btn-info btn-sm close-button"
                                                value="{{ $item->id }}">X</button>
                                            <img src="{{ asset('assets/admin/images/curriculums/images') }}/{{ $item->image }}"
                                                width="150" height="150">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label>File <small>(Please Upload only pdf)</small></label>
                                    <input type="file" name="file" class="form-control" accept=".pdf">
                                    @error('file')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    @if ($co_curriculum->file)
                                        <a class="btn btn-info" target="_blank"
                                            href="{{ asset('assets/admin/images/curriculums/pdf') }}/{{ $co_curriculum->file }}">View
                                            File</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label>Details</label>
                                    <textarea name="details" class="form-control" id="co_curriculum_details">{{ old('details', $co_curriculum->details) }}</textarea>
                                    @error('details')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Status<sup>*</sup></label>
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ $co_curriculum->status == 1 ? 'selected' : '' }}>
                                            Published
                                        </option>
                                        <option value="0" {{ $co_curriculum->status == 0 ? 'selected' : '' }}>
                                            Un-Published</option>
                                    </select>
                                    @error('status')
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
    <script src="{{ asset('/') }}assets/admin/libs/tinymce/tinymce.min.js"></script>

    <!-- Summernote js -->
    <script src="{{ asset('/') }}assets/admin/libs/summernote/summernote-bs4.min.js"></script>

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

        $(document).ready(function() {
            $('.close-button').click(function() {
                var checkstr = confirm('are you sure you want to delete this?');
                if (checkstr == true) {
                    var id = $(this).val();
                    var _token = "{{ csrf_token() }}";
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('delete.curruculum.image') }}',
                        data: {
                            '_token': _token,
                            id: id
                        },
                        success: function(data) {
                            location.reload();
                        }
                    });

                }else{
                    return false;
                }
            })
        })
    </script>
    <!-- init js -->
    <script src="{{ asset('/') }}assets/admin/js/pages/form-editor.init.js"></script>
    <!-- end row -->
    <!-- end row -->
@endsection
