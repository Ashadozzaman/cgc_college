<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admission Form</title>
    <style>
        .student-information {
            display: flex;
            text-align: center;
        }

        .first-section {
            width: 33.3%;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #c39c9c;
            text-align: left;
            padding: {{($student->section_id == 1)?'5px':'4px';}};
            /* width: 25%; */
        }


        th:nth-child(2n+1) {
            background-color: #f8f2f2;
            font-weight: bold;
        }

        td:nth-child(2n+1) {
            background-color: #f8f2f2;
            font-weight: bold;
        }
    </style>
</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50" style=" padding:10px 1%;font-size:16px;">
    <div class="container" style="border: 2px solid skyblue;padding:5px;">
        <div class="row" style="display: flex;border: 1px solid #c39c9c;padding-top: 3px;">
            <div class="col-md-3" style="width:25%;text-align:center;">
                <img src="{{ asset('/') }}assets/front/images/logo1.png" alt="your image"
                    style="height: 140px;width: 140px;" />
            </div>
            <div class="col-md-6 text-center" style="width:50%;text-align:center;">
                <h2 style="padding:0;color:red;margin:6px">ভর্তির আবেদন ফরম </h2>
                {{-- <h3 style="padding:0;margin:5px">কুমিল্লা সরকারি কলেজ</h3> --}}
                <h3 style="padding:0px;margin:5px">COMILLA GOVT. COLLEGE, CUMILLA</h3>
                <h4 style="padding:0;margin:5px">Policeline, Comilla, Bangladesh.</h4>
                <h4 style="padding:0;color:black;margin:5px">Phone: 081-65968, EIIN-
                    105824</h4>
                <h4 style="padding:0;color:black;margin:5px">Class-
                    XI, Session:
                    {{ $student->education_year - 1 }}-{{ $student->education_year }}</h4>
            </div>
            <div class="col-md-3" style="width:25%;text-align:center;">
                <img src="{{ asset('/') }}assets/front/images/user/{{ $student->image }}" alt="your image"
                    style="height: 140px;width: 140px;" />
            </div>
        </div>
        <div class="student-information">

            <table>
                <tr>
                    <td colspan="4" style="text-align: center;">Student Information</td>
                </tr>
                <tr>
                    <td style="width: 20%">Full Name</td>
                    <td style="width: 30%">{{ $student->full_name }}</td>
                    <td style="width: 20%">School</td>
                    <td style="width: 30%">{{ $student->details->school }}</td>
                </tr>
                <tr>
                    <td>Date Of Birth</td>
                    <td>{{ $student->details->dob }}</td>
                    <td>Student ID</td>
                    <td>{{ $student->student_id }}</td>
                </tr>
                <tr>
                    <td>Gruop</td>
                    <td>{{ $student->section->name }}</td>
                    <td>Class Roll</td>
                    <td>{{ $student->class_roll }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $student->email }}</td>
                    <td>SSC Roll</td>
                    <td>{{ $student->ssc_roll }}</td>
                </tr>
                <tr>
                    <td>Certificate</td>
                    <td>{{ $student->certificate->name }}</td>
                    <td>SSC Registration</td>
                    <td>{{ $student->details->ssc_reg }}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{ $student->details->ssc_reg == 'M' ? 'Male' : 'Female' }}</td>
                    <td>Phone</td>
                    <td>{{ $student->phone }}</td>
                </tr>
                <tr>
                    <td>SSC Board</td>
                    <td>{{ $student->ssc_board }}</td>
                    <td>SSC GPA</td>
                    <td>{{ $student->details->ssc_gpa }}</td>
                </tr>
                <tr>
                    <td>Marital Status</td>
                    <td>{{ $student->details->marital_status }}</td>
                    <td>SSC With GPA</td>
                    <td>{{ $student->details->ssc_gpa_forth }}</td>
                </tr>
                <tr>
                    <td>Religion</td>
                    <td>{{ $student->details->religion }}</td>
                    <td>Birth Registration</td>
                    <td>{{ $student->details->birth_registration }}</td>
                </tr>
                <tr>
                    <td>Parents Phone</td>
                    <td>{{ $student->details->parents_phone }}</td>
                    <td>Nationality</td>
                    <td>{{ $student->details->nationality }}</td>
                </tr>
                <tr>
                    <td>Subjects</td>
                    {{-- <td>Subjects</td> --}}
                    <td colspan="3" >
                        {{-- @foreach ($student->subject->sortBy('id') as $val)
                            <label style="margin-right: 2px">{{ Str::limit($val->details->main_subject->name, '50') }}
                                ({{ $val->details->subject_code }})
                                <sup>{{ $val->details->subject_status == '4th' ? $val->details->subject_status : '' }}</sup>
                                ,</label>
                        @endforeach --}}
                        @foreach ($main_subjects as $item)
                            <label>{{$item}},</label>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">Parents Information</td>
                </tr>
                <tr>
                    <td>Father's Name</td>
                    <td>{{ $student->details->father_name }}</td>
                    <td>Mother's Name</td>
                    <td>{{ $student->details->mother_name }}</td>
                </tr>
                <tr>
                    <td>Father's NID</td>
                    <td>{{ $student->details->father_nid }}</td>
                    <td>Mother's NID</td>
                    <td>{{ $student->details->mother_nid }}</td>
                </tr>
                <tr>
                    <td>Father's Occu..</td>
                    <td>{{ $student->details->father_occupation }}</td>
                    <td>Mother's Occu..</td>
                    <td>{{ $student->details->mother_occupation }}</td>
                </tr>
                <tr>
                    <td>Father's Income</td>
                    <td>{{ $student->details->father_yearly_income }}/Y</td>
                    <td>Mother's Income</td>
                    <td>{{ $student->details->mother_yearly_income }}/Y</td>
                </tr>
                <tr>
                    <td>Present Address </td>
                    <td>{{ $student->details->present_address }}</td>
                    <td>Permanent Add. </td>
                    <td>{{ $student->details->permanent_address }}</td>
                </tr>
                <tr>
                    <td>Local Guardian </td>
                    <td>{{ $student->details->local_guardian_name }}</td>
                    <td>Guardian Phone </td>
                    <td>{{ $student->details->local_guardian_mobile }}</td>
                </tr>
                <tr>
                    <td>Relation with Guardian</td>
                    <td>{{ $student->details->relation_local_guardian }}</td>
                    <td>Blood Group </td>
                    <td>{{ $student->details->blood_group }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="font-weight:300">
                        I, <b>{{ $student->full_name }}</b> do hereby declare that the above mentioned information and
                        photo are correct. If any information provided by me is found false, Cumilla Govt. College
                        reserves the right to cancel my admission. I shall be obliged to obey the rules and regulations of
                        College and pay all the required fees.
                    </td>
                </tr>
                <tr>
                    <td colspan="4">Bank Transaction No: </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top: 32px;font">
                        <u style="float: left;">শিক্ষার্থীর স্বাক্ষর</u>
                        <u style="float: right;">পিতা/মাতার স্বাক্ষর</u>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top: 32px;">
                        <u style="float: left;">অধ্যক্ষ স্বাক্ষর</u>
                        <u style="float: right;">ভর্তি কমিটির আহবায়ক স্বাক্ষর</u>
                    </td>
                </tr>
            </table>
        </div>
        <small>কুমিল্লা সরকারি কলেজে একাদশ শ্রেণিতে ভর্তির পর কুমিল্লা শহরস্থ অন্য কোন কলেজে বদলির জন্য আবেদন করা যাবে না।</small>
    </div>
</div>
</body>
<script>
    window.print();
    // window.close();
</script>
</html>
