@extends('layouts.front.master')
@section('title', 'Result History Page')
@section('custome-css')
@endsection
@section('content')
    <!-- CONTACT -->
    <div class="container">
        <section id="result">
            <div class="row">
                <div class="col-md-12">
                    @foreach ($results as $item)
                        <div class="">
                            <table class="kt-table-result- table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:13px;">
                                <thead>
                                    <tr>
                                        <th>Session</th>
                                        <th>Group</th>
                                        <th>Total Enrolled</th>
                                        <th>Total Appeared</th>
                                        <th>A<sup>+</sup></th>
                                        <th>A</th>
                                        <th>A<sup>-</sup></th>
                                        <th>B</th>
                                        <th>C</th>
                                        <th>D</th>
                                        <th>Absent</th>
                                        <th>Fail</th>
                                        <th>Pass</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item['results'] as $value)
                                    <tr>
                                        <td>{{$value->session_id}}</td>
                                        <td>{{$value->section->name}}</td>
                                        <td>{{$value->total_enrolled}}</td>
                                        <td>{{$value->total_appeared}}</td>
                                        <td>{{$value->ap}}</td>
                                        <td>{{$value->a}}</td>
                                        <td>{{$value->am}}</td>
                                        <td>{{$value->b}}</td>
                                        <td>{{$value->c}}</td>
                                        <td>{{$value->d}}</td>
                                        <td>{{$value->absent}}</td>
                                        <td>{{$value->fail}}</td>
                                        <td>{{$value->pass}}</td>
                                        <td>{{$value->percentage}}%</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="13" style="text-align: right;">Total Percentage</td>
                                        <td>{{$item['final_percentage']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
@section('custome-js')

@endsection

