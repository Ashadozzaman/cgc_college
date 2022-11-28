@extends('layouts.admin.master')
@section('title', 'Result Generate')
@section('custome-css')
<style>

.mark-check{
  float: left;
  margin-right: 35px;
}
.exam-result{
    padding: 25px 5px;
    border-radius: 4px;
    border: 1px solid lightblue;
    margin-top:10px;
}
.exam-result h4{
    color: cornflowerblue;
    font-weight: bold;
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
                    <h4 class="card-title">Result Generate</h4>
                    <p class="card-title-desc">Result Generate here....!</p>
                    @include('_message')
                    <div class="exam-result">
                        <h4>Result Subject Wise</h4>
                        <form action="{{route('get.result.each.exam')}}" method="POST" id="form_submit">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="" class="form-control">Select Exam</label>
                                </div>
                                <div class="col-md-5">
                                    <select name="exam_id" id="" class="form-control" required>
                                        <option value="">Select Exam</option>
                                        @foreach ($exams as $item)
                                        <option value="{{$item->id}}">{{$item->title}} ({{$item->session - 1}} - {{$item->session}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit">View</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="exam-result">
                        <h4>Section Wise Result</h4>
                        <form action="{{route('get.result.section')}}" method="POST" id="form_submit">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <select name="section_id" id="" class="form-control" required>
                                        <option value="">Select Section</option>
                                        @foreach ($section as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <select name="exam_id" id="" class="form-control" required>
                                        <option value="">Select Exam</option>
                                        @foreach ($exams as $item)
                                        <option value="{{$item->id}}">{{$item->title}} ({{$item->session - 1}} - {{$item->session}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit">View</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="exam-result">
                        <h4>Main Subject Wise Result </h4>
                        <form action="{{route('get.result.mainSubjectWise')}}" method="POST" id="form_submit" target="_blank">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <select name="section_id" id="" class="form-control" required>
                                        <option value="">Select Section</option>
                                        @foreach ($section as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <select name="exam_id" id="" class="form-control" required>
                                        <option value="">Select Exam</option>
                                        @foreach ($exams as $item)
                                        <option value="{{$item->id}}">{{$item->title}} ({{$item->session - 1}} - {{$item->session}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" name="button" class="btn btn-primary" value="View">
                                    <input type="submit" name="button" class="btn btn-success" value="Print">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="exam-result">
                        <h4>Full Subject Result</h4>
                        <form action="{{route('get.result.full.subject')}}" method="POST" id="form_submit" target="_blank">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <select name="section_id" id="" class="form-control" required>
                                        <option value="">Select Section</option>
                                        @foreach ($section as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <select name="exam_id" id="" class="form-control" required>
                                        <option value="">Select Exam</option>
                                        @foreach ($exams as $item)
                                        <option value="{{$item->id}}">{{$item->title}} ({{$item->session - 1}} - {{$item->session}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success" type="submit" target="_blank">Print</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{--<div class="exam-result">
                        <h4>Show Result Main Subject Wise......</h4>
                        <form action="{{route('get.result.mainSubjectWise')}}" method="POST" id="form_submit">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <select name="section_id" id="" class="form-control" required>
                                        <option value="">Select Section</option>
                                        @foreach ($section as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <select name="exam_id" id="" class="form-control" required>
                                        <option value="">Select Exam</option>
                                        @foreach ($exams as $item)
                                        <option value="{{$item->id}}">{{$item->title}} ({{$item->session - 1}} - {{$item->session}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>--}}
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <!-- end row -->
@endsection
