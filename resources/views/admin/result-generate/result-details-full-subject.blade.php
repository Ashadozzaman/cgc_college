<!DOCTYPE html>
<html>

<head>
    <title>Result Comilla Govt. College</title>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #c39c9c;
            text-align: left;
        }


        th:nth-child(2n+1) {
            background-color: #f8f2f2;
            /* font-weight: bold; */
        }

        td:nth-child(2n+1) {
            background-color: #f8f2f2;
            /* font-weight: bold; */
        }

        tr,
        td,
        th {
            padding: 2px !important;
            text-align: center;
        }
    </style>

</head>

<body>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="display: flex;border: 1px solid #c39c9c;padding-top: 3px;">
                        <div class="col-md-3" style="width:25%;text-align:center;">
                            <img src="{{ asset('/') }}assets/front/images/logo1.png" alt="your image"
                                style="height: 140px;width: 140px;" />
                        </div>
                        <div class="col-md-6 text-center" style="width:50%;text-align:center;">
                            <h3 style="padding:0px;margin:5px">COMILLA GOVT. COLLEGE, CUMILLA</h3>
                            <h3 style="padding:0px;margin:5px">Result: {{ $exam->title }} <small>({{ $section->name }})</small></h3>
                            <h5 style="padding:0px;margin:5px">Session:
                                {{ $exam->session - 1 }}-{{ $exam->session }} : Result Generate:
                                {{ date('d-M-Y') }}</h5>
                            <table style="width: 50%;margin-left:27%;">
                                <tr>
                                    <td colspan="3">BANGLA</td>
                                </tr>
                                <tr>
                                    <td colspan="3">GPA</td>
                                </tr>
                                <tr>
                                    <td>CQ</td>
                                    <td>MCQ</td>
                                    <td>PRACTICAL</td>
                                </tr>
                            </table>
                            <br>
                        </div>
                        <div class="col-md-3" style="width:25%;text-align:center;">
                            <table style="width: 100%;">
                                <tr>
                                    <td colspan="4">GPA Details</td>
                                </tr>
                                <tr>
                                    <td>Mark</td>
                                    <td>GPA</td>
                                    <td>Mark</td>
                                    <td>GPA</td>
                                </tr>
                                <tr>
                                    <td>80 - 100</td>
                                    <td>A<sup>+</sup></td>
                                    <td>70 - 79</td>
                                    <td>A<sup></sup></td>
                                </tr>
                                <tr>
                                    <td>60 - 69</td>
                                    <td>A<sup>-</sup></td>
                                    <td>50 - 59</td>
                                    <td>B<sup></sup></td>
                                </tr>
                                <tr>
                                    <td>40 - 49</td>
                                    <td>C<sup></sup></td>
                                    <td>33 - 39</td>
                                    <td>D</td>
                                </tr>
                                <tr>
                                    <td>0 - 32</td>
                                    <td>F</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>
                    @include('_message')
                    <div class="subject">
                        <table class="kt-table-result- table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:12px;">
                            <thead>
                                <tr>
                                    <th>Roll</th>
                                    @foreach ($subject_details as $item)
                                    <th title="{{$item['main_subject']}}">{{strtoupper(substr($item['main_subject'], 0, 3))}}<br>{{$item['subject_code']}}</th>
                                    @endforeach
                                    <th style="width: 90px">Total Mark<br>(Rank)</th>
                                    <th>GPA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subject_result_details as $srd => $item)
                                <tr>
                                    <td>{{$item['class_roll']}}</td>
                                    @foreach ($item['results'] as $value)
                                    <td>
                                        {{($value['gpa'] == "F")?$value['gpa']:number_format($value['gpa'], 2)}}
                                        <table style="width: 100%">
                                            <tr>
                                                <td>{{ $value['cq'] }}</td>
                                                <td>{{ $value['mcq'] == 0 ? 'x' : $value['mcq'] }}</td>
                                                <td>{{ $value['practical'] == 0 ? 'x' : $value['practical'] }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                    @endforeach
                                    <td>{{$item['total_mark']}}<sup>({{$item['possition']}})</sup></td>
                                    <td>{{($item['gpa'] == "F")?$item['gpa']:number_format($item['gpa'], 2)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
<script>
    window.onafterprint = window.close;
    window.print();
</script>
</body>

</html>
