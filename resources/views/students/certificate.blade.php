<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شهادة الطالب</title>
    <style>
        body {
            font-family: 'Markazi Text';
            font-size: 15pt;
            direction: rtl;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #0f264f;
            padding: 10px 0;
        }
        #banner-right, #banner-left, #banner-center {
            flex: 1;
            text-align: center;
        }
        #ImageLogoRight, #ImageLogoLeft {
            width: auto;
            max-height: 80px;
        }
        #ImageLogoMiddle {
            width: auto;
            max-height: 100px;
        }
        h2 {
            font: 15pt Trebuchet MS, Lucida Grande, Lucida Sans Unicode;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
        .certificate-container {
            max-width: 90%;
            width: 100%;
            padding: 1rem;
            margin: 25px auto;
            box-sizing: border-box;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
        }
        th {
            font-weight: bold;
            font-size: 16px;
            background: linear-gradient(to bottom, #eeedf3, #a9a8c1);
            height: 30px;
        }
        td {
            background-color: #f0f3f8;
        }
        .form-summary {
            margin-top: 30px;
        }
        .form-qr {
            display: flex;
            justify-content: start;
            margin-bottom: 1%;
            margin-right: 1%;
        }
        .qr-box {
            width: 15%;
        }
        .qr-note h3 {
            font-size: 16px;
        }
        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0f264f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px;
        }
        .back-btn:hover {
            background-color: #1a3a6e;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                height: auto;
                padding: 10px;
            }
            #banner-right, #banner-left {
                display: none;
            }
            #banner-center {
                width: 100%;
            }
            #ImageLogoMiddle {
                max-width: 150px;
            }
            h2 {
                font-size: 12pt;
                padding: 0 10px;
            }
            .certificate-container {
                margin: 15px;
                padding: 1rem;
            }
            th, td {
                font-size: 12px;
            }
            .qr-box {
                width: 50%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div id="banner-right">
            <img id="ImageLogoRight" alt="Educational Right Logo" src="{{ asset('assets/images/EduLogoRight.png') }}">
        </div>
        <div id="banner-center">
            <img id="ImageLogoMiddle" alt="Central Educational Logo" src="{{ asset('assets/images/EduLogo-EmptyBackground.png') }}">
        </div>
        <div id="banner-left">
            <img id="ImageLogoLeft" alt="Educational Left Logo" src="{{ asset('assets/images/EduLogoLeft.png') }}">
        </div>
    </div>
    
    <h2>نتائج امتحانات شهادتي إتمام مرحلتي التعليم الأساسي والثانوي للعام الدراسي {{ $student->academic_year ?? '2024 / 2025' }}</h2>

    <div class="certificate-container">
        <table>
            <thead>
                <tr>
                    <th>رقم القيد</th>
                    <th>رقم الجلوس</th>
                    <th>اسم الطالب</th>
                    <th>صفة القيد</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2715514</td>
                    <td>{{ $student->seat_number ?? '' }}</td>
                    <td>{{ $student->student_name ?? '' }}</td>
                    <td>نظامي</td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead style="height: 100px;">
                <tr>
                    <th>المادة</th>
                    <th>درجة الامتحان</th>
                    <th>درجات إضافية</th>
                    <th>الامتحان النهائي</th>
                    <th>درجة النجاح</th>
                    <th>الامتحان المدرسي</th>
                    <th>أعمال السنة</th>
                    <th>الإجمالي</th>
                    <th>درجة النجاح في المادة</th>
                    <th>ملاحظة</th>
                    <th>المعدل العام</th>
                </tr>
            </thead>
            @php
                $subjects = [
                    'التربية الاسلامية' => ['passing' => 40, 'max_total' => 80],
                    'اللغة العربية' => ['passing' => 80, 'max_total' => 160],
                    'اللغة الانجليزية' => ['passing' => 80, 'max_total' => 160],
                    'تقنية المعلومات' => ['passing' => 40, 'max_total' => 80],
                    'الرياضيات' => ['passing' => 100, 'max_total' => 200],
                    'الاحصاء' => ['passing' => 40, 'max_total' => 80],
                    'الفيزياء' => ['passing' => 100, 'max_total' => 200],
                    'الكيمياء' => ['passing' => 80, 'max_total' => 160],
                    'الاحياء' => ['passing' => 80, 'max_total' => 160],
                ];
                $first = true;
            @endphp
            <tbody>
            @foreach ($subjects as $subject => $config)
                <tr>
                    <td>{{ $subject }}</td>
                    <td>{{ isset($student->grades[$subject]['max']) ? number_format($student->grades[$subject]['max'], 2) : '' }}</td>
                    <td>{{ isset($student->grades[$subject]['min']) ? number_format($student->grades[$subject]['min'], 2) : '' }}</td>
                    <td>{{ (isset($student->grades[$subject]['work']) && isset($student->grades[$subject]['max'])) 
                        ? number_format($student->grades[$subject]['work'], 2) . ' / ' . number_format($student->grades[$subject]['max'], 2) 
                        : '' }}</td>
                    <td>{{ isset($student->grades[$subject]['exam']) ? number_format($student->grades[$subject]['exam'], 2) : '' }}</td>
                    <td>{{ isset($student->grades[$subject]['passing']) ? number_format($student->grades[$subject]['passing'], 2) : '' }}</td>
                    <td>{{ isset($student->grades[$subject]['school_exam']) ? number_format($student->grades[$subject]['school_exam'], 2) : '' }}</td>
                    <td>{{ isset($student->grades[$subject]['total']) ? number_format($student->grades[$subject]['total'], 2) . ' / ' . number_format($config['max_total'], 2) : '' }}</td>
                    <td>{{ isset($student->grades[$subject]['note']) ? $student->grades[$subject]['note'] : number_format($config['passing'], 2) }}</td>
                    <td>{{ isset($student->grades[$subject]['result']) ? $student->grades[$subject]['result'] : '' }}</td>
                    @if($first)
                    <td rowspan="9" style="vertical-align: middle; text-align: center;">
                        {{ $student->overall_average ? number_format($student->overall_average, 2) : '' }}
                    </td>
                    @php $first = false; @endphp
                    @endif
                </tr>
            @endforeach
                    </tbody>
        </table>

        <!-- Summary Section -->
        <div class="form-summary">
            <table class="table-bordered" style="width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        <th>عدد المواد</th>
                        <th>عدد المواد الناجح فيها الطالب</th>
                        <th>عدد المواد الراسب فيها الطالب</th>
                        <th>المجموع</th>
                        <th>المعدل العام</th>
                        <th>التقدير</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $student->total_subjects ?? '' }}</td>
                        <td>{{ $student->passed_subjects ?? '' }}</td>
                        <td>{{ $student->failed_subjects ?? '' }}</td>
                        <td>{{ $student->total ?? '' }}</td>
                        <td>{{ $student->overall_average ?? '' }}</td>
                        <td>{{ $student->grade ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if (isset($qrCode))
        <div class="form-qr">
            <div class="qr-box">{!! $qrCode !!}</div>
            <div class="qr-note">
                <h3>يمكنك قراءة الرمز للتحقق من صحة البيانات</h3>
            </div>
        </div>
        @endif

        <a href="{{ route('students.create') }}" class="back-btn">إضافة طالب جديد</a>
        <a href="{{ route('students.edit', $student->id) }}" style="padding: 10px 20px; background-color: #ffc107; color: black; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px; text-decoration: none;">تعديل</a>
        
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">تسجيل الخروج</button>
        </form>
    </div>
</body>
</html>
