@extends('layouts.admin.master')
@section('title', 'Result Generate')
@section('custome-css')
    <style>
        .mark-check {
            float: left;
            margin-right: 35px;
        }
    </style>
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Result Generate</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Result Generate</li>/
                        <a href="{{ route('result_generate.index') }}">MarK List</a>
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
                    <h4 class="card-title">Result Generate</h4>
                    <p class="card-title-desc">Result Generate here....!</p>
                    @include('_message')
                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-4">
                                <label>Select Exam <sup>*</sup></label>
                                <input type="text" readonly value="{{ $markDetails->exam->title }}" class="form-control">
                                @error('exam_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-4">
                                <label>Subject</label>
                                <input type="text" readonly value="{{ $markDetails->subject->name }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label>Section<sup>*</sup></label>
                                <input type="text" readonly value="{{ $markDetails->section->name }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-4">
                                <label>Total Mark</label>
                                <input type="number" readonly class="form-control"
                                    value="{{ $markDetails->total_mark }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label>CQ</label>
                                <input type="number" readonly class="form-control" value="{{ $markDetails->cq }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-4">
                                <label>MCQ</label>
                                <input type="number" readonly class="form-control" value="{{ $markDetails->mcq }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-4">
                                <label>Practical</label>
                                <input type="number" readonly class="form-control" value="{{ $markDetails->practical }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-4">
                                <label>Subject Code</label>
                                <input type="text" readonly class="form-control" value="{{ $markDetails->subject_code }}">
                            </div>
                        </div>

                    </div>
                    <hr>
                    <form action="{{route('result-import')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mark_setup_id" value="{{$markDetails->id}}">
                        <input type="hidden" name="subject_code" value="{{$markDetails->subject_code}}">
                        <input type="hidden" name="exam_id" value="{{$markDetails->exam_id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-control">Excel File <small>(student_id,cq,mcq,practical,subject_code) Follow this instruction</small></label>
                            </div>
                            <div class="col-md-5">
                                <input class="form-control" name="file" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"  required>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary"> Submit </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <form action="{{ route('result_generate.store') }}" method="POST" id="form_submit"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-1">
                                <label for="Name">No</label>
                            </div>
                            <div class="col-md-2">
                                <label for="Name">Student ID</label>
                            </div>
                            <div class="col-md-1">
                                <label for="Name">Class Roll</label>
                            </div>
                            <div class="col-md-4">
                                <label for="Name">Name</label>
                            </div>
                            <div class="col-md-1">
                                <label for="Name">Session</label>
                            </div>
                            <div class="col-md-1">
                                <label for="Name">CQ</label>
                            </div>
                            <div class="col-md-1">
                                <label for="Name">MCQ</label>
                            </div>
                            <div class="col-md-1">
                                <label for="Name">Practical</label>
                            </div>
                        </div>
                        <input type="hidden" name="mark_setup_id" value="{{$markDetails->id}}">
                        <input type="hidden" name="subject_code" value="{{$markDetails->subject_code}}">
                        <input type="hidden" name="exam_id" value="{{$markDetails->exam_id}}">
                        @foreach ($result_details as $key => $student)
                        <input type="hidden" name="id[]" multiple value="{{$student->id}}">
                        <div class="row" style="margin-top:5px">
                            <div class="col-md-1">
                                <input type="number" value="{{$key + 1}}" class="form-control" readonly>
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="student_id[]" multiple value="{{$student->student_id}}" class="form-control" readonly>
                            </div>
                            <div class="col-md-1">
                                <input type="text" value="{{$student->student->class_roll}}" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <input type="text" value="{{$student->student->full_name}}" class="form-control" readonly>
                            </div>
                            <div class="col-md-1">
                                <input type="text" value="{{$student->student->education_year}}" class="form-control" readonly>
                            </div>
                            <div class="col-md-1">
                                <input type="number" name="cq[]" multiple type="number" value="{{$student->cq}}" class="form-control"  min="0"  max="{{ $markDetails->cq }}" style="{{($student->cq < 1)?"border:1px solid red":"";}} ">
                            </div>
                            <div class="col-md-1">
                                <input type="number" name="mcq[]" multiple value="{{$student->mcq}}" class="form-control" min="0"  max="{{ $markDetails->mcq }}">
                            </div>
                            <div class="col-md-1">
                                <input type="number" name="practical[]" multiple value="{{$student->practical}}" class="form-control" min="0" max="{{ $markDetails->practical }}">
                            </div>
                        </div>
                        @endforeach
                        <br>
                        <button class="btn btn-primary" type="submit">Save Result</button>
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
    <script>
        $(document).ready(function() {
            $('input[type="number"]').on('keyup',function(){
                v = parseInt($(this).val());
                min = parseInt($(this).attr('min'));
                max = parseInt($(this).attr('max'));

                if (v < min){
                    $(this).val(min);
                } else if (v > max){
                    $(this).val(max);
                }
            })

            $('#button_submit_').click(function() {
                var cq = $('#cq').val();
                var mcq = $('#mcq').val();
                var practical = $('#practical').val();
                var total = $('#total').val();
                var subject_id = $('#subject_id').val();

                var total_mark = (parseInt(cq) + parseInt(mcq) + parseInt(practical));
                if (subject_id == "") {
                    $('#error_subject').html('Subject Must be required!!');
                    return false;
                } else {
                    $('#error_subject').html('');
                }
                if (total_mark > total) {
                    $('#error_mark').html('Your mark is more than total mark');
                    return false;
                } else if (total_mark < total) {
                    $('#error_mark').html('Your mark is less than total mark');
                    return false;
                } else {
                    $('#error_mark').html('');
                    $('#form_submit').submit();
                }

            })

        })
    </script>
@endsection
