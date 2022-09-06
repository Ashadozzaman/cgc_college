<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Card</title>
    <style>
        .student-card {
            width: 209px;
            background: #e0f3fb;
            height: 330px;
            float: left;
            margin: 0;
            border-radius: 114px 5px 104px;
            position: relative;
        }

        .student-card-back {
            width: 209px;
            background: #e0f3fb;
            height: 330px;
            float: left;
            margin: 5px;
            border: 2px solid black;
            border-radius: 5px;

        }

        .card-border {
            width: 209px;
            height: 330px;
            float: left;
            margin: 5px;
            border: 2px solid black;
            background: DA555;
            background: #f26826;
            border-radius: 5px;
        }

        .student-card h4 {
            padding: 0px;
            margin: 0;
            position: absolute;
            top: 3px;
            font-size: 12px;
            left: 40px;
        }

        .profile {
            text-align: center;
            margin-top: -25px;
        }

        .profile img {
            height: 90px;
            width: 90px;
        }

        .details {
            text-align: center;
            margin-top: -6px;
            line-height: 1;
        }

        .name {
            font-size: 13px;
            font-weight: bold;
            color: #f26826;
        }

        .principle {
            text-align: center;
        }

        #brack {
            width: 219px;
            height: 509px;
            /* height: 352px;//use customise print */
            float: left;
        }
    </style>
</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50" style="font-size:15px;">
    <div class="container">
        @php
            $year = 0;
        @endphp
        @foreach ($students as $student)
            @php
                $year = $student->education_year + 1;
                $details = "Name: $student->full_name || Student Id: $student->student_id || Class Roll: $student->class_roll || Phone: $student->phone || Thanks for choosed Cumilla Govt. College ";
            @endphp
            <div id="brack">
                <div class="card-border">
                    <div class="student-card">
                        <img src="{{ asset('/') }}assets/front/images/logo1.png" alt="your image"
                            style="height: 40px;width: 40px;" />
                        <h4>COMILLA GOVT. COLLEGE</h4>
                        <div class="profile">
                            @if ($student->image)
                                <img src="{{ asset('/') }}assets/front/images/user/{{ $student->image }}"
                                    alt="your image" />
                            @else
                                <img src="{{ asset('/') }}assets/front/images/demo-pic-card.jpg" alt="your image" />
                            @endif

                        </div>
                        <div class="details">
                            <strong style="font-size: 12px;">Group:
                                {{ ucwords(strtolower($student->section->name)) }}</strong><br>
                            <strong class="name">{{ strtoupper($student->full_name) }}</strong><br>
                            <strong style="font-size: 11px;">Father's Name: {{ $student->details['father_name'] }}</strong><br>
                            <strong style="font-size: 12px;">Session: {{ $student->education_year - 1 }} -
                                {{ $student->education_year }} </strong><br>
                            <strong style="font-size: 12px;">Guardian Mobile:
                                {{ $student->details['parents_phone'] }}</strong><br>
                            <strong style="font-size: 13px;">Class Roll: {{ $student->class_roll }}</strong><br>
                        </div>
                        <div class="qr-code" style="text-align: center;">
                            {!! QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)->size(60)->generate($details) !!}<br>
                            <strong style="font-size: 14px;">ID: {{ $student->student_id }}</strong><br>
                        </div>
                        <div class="principle">
                            <strong style="font-size: 11px;color:#f26826">Professor Md. Bahadur Hossain</strong><br>
                            <strong style="font-size: 11px;">Principal</strong><br>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="student-card-back">
            <div class="first" style="padding: 15px 22px;text-align:center;">
                <strong>If found please return to:</strong>
            </div>
            <div class="second" style="padding: 0px 25px;text-align:center;">
                <strong> Principal</strong><br>
                <strong>
                    Comilla Govt. College
                    Policeline, Cumilla-3500
                    Phone: 081-65968
                </strong>
            </div>
            <div class="last" style="padding: 10px 25px;text-align:center;">
                <strong>VALIDITY:<br> UPTO 30 JUNE {{$year}}</p></strong>
            </div>
        </div>

    </div>
</body>
<script>
    //window.print();
    // window.close();
</script>

</html>
