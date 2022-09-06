@extends('layouts.admin.master')
@section('title', 'Mark Setup')
@section('custome-css')
<style>
    
.mark-check{
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
                <h4 class="page-title mb-0 font-size-18">Mark Setup</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Mark Setup</li>/
                        <a href="{{ route('mark_setup.index') }}">MarK List</a>
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
                    <h4 class="card-title">Mark Setup</h4>
                    <p class="card-title-desc">Mark Setup here....!</p>
                    @include('_message')
                    <form action="{{ route('mark_setup.update',$mark_setup->id) }}" method="POST" id="form_submit">
                        @csrf
                        @method('put')
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Select Exam <sup>*</sup></label>
                                    <select name="exam_id" class="form-control get-subject" required id="exam_id">
                                        <option value="">Select section</option>
                                        @foreach ($exams as $exam)
                                            <option value="{{ $exam->id }}" {{($mark_setup->exam_id == $exam->id)?'selected':'';}}>{{ $exam->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('exam_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Section<sup>*</sup></label>
                                    <select name="section_id" class="form-control get-subject" required id="section_id">
                                        <option value="">Select section</option>
                                        @foreach($sections as $section)
                                            <option value="{{$section->id}}" {{($mark_setup->section_id == $section->id)?'selected':'';}}>{{$section->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Select Subject <small>(Please initially choose exam and section)</small></label>
                                    <select name="subject_code" class="form-control" required id="subject_id">
                                        <option value="">Select Subject</option>
                                    </select>
                                    <input type="hidden" value="{{$mark_setup->subject_code}}" id="selected_subject">
                                    @error('subject_code')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="text-danger" id="error_subject"></div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Teacher</label>
                                    <select name="teacher_id" class="form-control" required>
                                        <option value="0">Select section</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" {{($mark_setup->teacher_id == $teacher->id)?'selected':'';}}>{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Total Mark</label>
                                    <input type="number" name="total_mark" id="total" class="form-control" value="{{$mark_setup->total_mark}}">
                                    @error('total_mark')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="text-danger" id="error_mark"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>CQ</label>
                                    <input type="number" name="cq" id="cq" class="form-control" value="{{$mark_setup->cq}}">
                                    @error('cq')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>MCQ</label>
                                    <input type="number" name="mcq" id="mcq" class="form-control" value="{{$mark_setup->mcq}}">
                                    @error('mcq')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label>Practical</label>
                                    <input type="number" name="practical" id="practical" class="form-control" value="{{$mark_setup->practical}}">
                                    @error('practical')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary" type="button" id="button_submit">Save</button>
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
    $(document).ready(function(){
        get_subject();
        function get_subject(){
            var section_id = $('#section_id').val();
            var exam_id    = $('#exam_id').val();
            var selected_subject    = $('#selected_subject').val();
            if(section_id == '' || exam_id == ''){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{{route('subject.choose')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'section_id': section_id,
                    'exam_id': exam_id,
                },
                success: function (data) {
                    var subject = data.data;
                    // the next thing you want to do 
                    $('#subject_id').empty();
                    var html = '';
                    for (var i = 0; i < subject.length; i++) {
                        if (selected_subject == subject[i].subject_code) {
                            html += "<option id='" + subject[i].subject_code + "' value='" + subject[i].subject_code + "' selected>" + subject[i].name + "</option>";
                        }else{
                            html += "<option id='" + subject[i].subject_code + "' value='" + subject[i].subject_code + "'>" + subject[i].name + "</option>";
                        }
                    }
                    // console.log(html);
                    $('#subject_id').append(html);
                }
            });
        }
        $('.get-subject').change(function(){
            get_subject();
        });

        $('#button_submit').click(function(){
            var cq = $('#cq').val();
            var mcq = $('#mcq').val();
            var practical = $('#practical').val();
            var total = $('#total').val();
            var subject_id = $('#subject_id').val();

            var total_mark = (parseInt(cq) + parseInt(mcq) + parseInt(practical));
            if(subject_id == ""){
                $('#error_subject').html('Subject Must be required!!');
                return false;
            }else{
                $('#error_subject').html('');
            }
            if (total_mark > total) {
                $('#error_mark').html('Your mark is more than total mark');
                return false;
            }else if(total_mark < total){
                $('#error_mark').html('Your mark is less than total mark');
                return false;
            }else{
                $('#error_mark').html('');
                $('#form_submit').submit();
            }

        })

    })
</script>
@endsection