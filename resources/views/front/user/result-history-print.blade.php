<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .text-center {
            text-align: center;
        }
        .full-table{
            border: 2px solid gainsboro;
            padding: 3px;
        }
        h2,h3{
            padding: 0;
            margin: 5px;
        }
    </style>
</head>

<body>

    <h2 class="text-center">Cumilla Govt. College</h2>
    <h3 class="text-center">Phone: 081-65968, EIIN- 105824 </h3>
    <h3 class="text-center"> Class- XI, Session: 2021-2022 </h3>
    <h2 class="text-center">{{ $student->full_name }} Result Summery</h2>
    @foreach ($exam_wises as $item)
        <div class="full-table">
            <h3 class="col-md-12 text-center"> <b>{{ $item['exam'] }}</b></h3>
            <table>
                <tr>
                    @foreach ($item['main_subjects'] as $val)
                        <th title="{{ $val->name }}">{{ $val->name }}</th>
                    @endforeach
                    <th>GPA</th>
                </tr>
                <tr>
                    @foreach ($item['main_subjects_result'] as $m_val)
                        @php
                            if ($m_val['status'] == '4th') {
                                $background = 'lightgray';
                            } else {
                                $background = '';
                            }
                        @endphp
                        <td style="background: {{ $background }}">
                            {{ $m_val['result'] == 'F' ? $m_val['result'] : number_format($m_val['result'], 2) }}
                        </td>
                    @endforeach
                    <td>{{ $item['main_total_gpa'] == 'F' ? $item['main_total_gpa'] : number_format($item['main_total_gpa'], 2) }}
                    </td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    @foreach ($item['subjects'] as $val)
                        <th title="{{ $val->main_subject->name }}">
                            {{ strtoupper(substr($val->main_subject->name, 0, 3)) }}<br>{{ $val->subject_code }}
                        </th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($item['results'] as $result)
                        <td>{{ $result == 'F' ? $result : number_format($result, 2) }}</td>
                    @endforeach
                    {{-- <td>{{($item['total_gpa'] == "F")?$item['total_gpa']:number_format($item['total_gpa'], 2)}}</td> --}}
                </tr>
                <tr>
                    <td colspan="{{ count($item['totalMarks']) }}" class="text-center"><b>Total Mark Each Subject</b>
                    </td>
                </tr>
                <tr>
                    @foreach ($item['totalMarks'] as $mark)
                        <td>{{ $mark }}</td>
                    @endforeach
                </tr>
            </table>
        </div>
        <hr>
    @endforeach

</body>

<script>
    window.print();
    window.close();
</script>

</html>
