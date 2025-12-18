<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة طالب</title>
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
        .form-container {
            max-width: 90%;
            width: 100%;
            padding: 1rem;
            margin: 25px auto;
            box-sizing: border-box;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .input-field, .input-select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        td input, td select {
            width: 95%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
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
        .btn-primary {
            border: 1px solid black;
            padding: 10px 20px;
            color: black;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            background-color: #E8E8E8;
            transition: background-color 0.3s ease;
            font-size: 15pt;
        }
        .btn-primary:hover {
            background-color: #ccc;
        }
        .logout-btn {
            padding: 8px 16px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .alert-danger {
            color: red;
            margin-top: 10px;
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
            .form-container {
                margin: 15px;
                padding: 1rem;
            }
            th, td {
                font-size: 12px;
            }
            .btn-primary {
                width: 100%;
                padding: 10px;
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
    
    <h2>إضافة طالب جديد - نتائج امتحانات شهادتي إتمام مرحلتي التعليم الأساسي والثانوي</h2>

    <div class="form-container">
        <div style="text-align: left; margin-bottom: 15px;">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">تسجيل الخروج</button>
            </form>
        </div>
    </div>

    <form action="{{ route('students.store') }}" method="POST" class="form-container">
        @csrf
        <div dir="rtl">
            <!-- Academic Year -->
            <div style="margin-bottom: 20px; text-align: center;">
                <label style="font-weight: bold; font-size: 16px;">العام الدراسي: </label>
                <input type="text" name="academic_year" id="academic_year" 
                    value="{{ old('academic_year', $student->academic_year ?? '2024 / 2025') }}"
                    style="padding: 8px; border: 1px solid #ccc; border-radius: 5px; width: 150px; text-align: center;"
                    {{ $isViewOnly ? 'disabled' : 'required' }}>
            </div>

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
                        <td>
                            <input type="text" id="seat_number" name="seat_number" 
                                {{ $isViewOnly ? 'disabled' : 'required' }}
                                value="{{ old('seat_number', $student->seat_number ?? '') }}">
                        </td>
                        <td>
                            <input type="text" name="student_name" id="student_name"
                                value="{{ old('student_name', $student->student_name ?? '') }}"
                                {{ $isViewOnly ? 'disabled' : 'required' }}>
                        </td>
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
                <tbody>
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
                    @foreach ($subjects as $subject => $config)
                        <tr>
                            <td>{{ $subject }}</td>
                            <!-- درجة الامتحان (max) -->
                            <td><input type="number" step="0.01" name="grades[{{ $subject }}][max]" value="{{ old('grades.' . $subject . '.max', $student->grades[$subject]['max'] ?? '') }}" {{ $isViewOnly ? 'disabled' : 'required' }}></td>
                            <!-- درجات إضافية (min - stored but displayed empty on show) -->
                            <td><input type="number" step="0.01" name="grades[{{ $subject }}][min]" value="{{ old('grades.' . $subject . '.min', $student->grades[$subject]['min'] ?? '') }}" {{ $isViewOnly ? 'disabled' : '' }}></td>
                            <!-- الامتحان النهائي (work) -->
                            <td><input type="number" step="0.01" name="grades[{{ $subject }}][work]" value="{{ old('grades.' . $subject . '.work', $student->grades[$subject]['work'] ?? '') }}" {{ $isViewOnly ? 'disabled' : 'required' }}></td>
                            <!-- درجة النجاح (exam) -->
                            <td><input type="number" step="0.01" name="grades[{{ $subject }}][exam]" value="{{ old('grades.' . $subject . '.exam', $student->grades[$subject]['exam'] ?? '') }}" {{ $isViewOnly ? 'disabled' : 'required' }}></td>
                            <!-- الامتحان المدرسي (passing - stored but displayed empty on show) -->
                            <td><input type="number" step="0.01" name="grades[{{ $subject }}][passing]" value="{{ old('grades.' . $subject . '.passing', $student->grades[$subject]['passing'] ?? '') }}" {{ $isViewOnly ? 'disabled' : '' }}></td>
                            <!-- أعمال السنة (school_exam) -->
                            <td><input type="number" step="0.01" name="grades[{{ $subject }}][school_exam]" value="{{ old('grades.' . $subject . '.school_exam', $student->grades[$subject]['school_exam'] ?? '') }}" {{ $isViewOnly ? 'disabled' : 'required' }}></td>
                            <!-- الإجمالي (total) -->
                            <td><input type="number" step="0.01" name="grades[{{ $subject }}][total]" value="{{ old('grades.' . $subject . '.total', $student->grades[$subject]['total'] ?? '') }}" {{ $isViewOnly ? 'disabled' : 'required' }}></td>
                            <!-- درجة النجاح في المادة (static) -->
                            <td>
                                <input type="text" value="{{ number_format($config['passing'], 2) }}" disabled>
                                <input type="hidden" name="grades[{{ $subject }}][note]" value="{{ $config['passing'] }}">
                            </td>
                            <!-- ملاحظة (result) -->
                            <td>
                                <select name="grades[{{ $subject }}][result]" {{ $isViewOnly ? 'disabled' : '' }}>
                                    <option value="ناجح" {{ (old('grades.' . $subject . '.result', $student->grades[$subject]['result'] ?? '') == 'ناجح') ? 'selected' : '' }}>ناجح</option>
                                    <option value="راسب" {{ (old('grades.' . $subject . '.result', $student->grades[$subject]['result'] ?? '') == 'راسب') ? 'selected' : '' }}>راسب</option>
                                </select>
                            </td>
                            @if($first)
                            <!-- المعدل العام -->
                            <td rowspan="9">
                                <input type="number" step="0.01" name="overall_averagee" id="overall_averagee" class="input-field" placeholder="المعدل العام" {{ $isViewOnly ? 'disabled' : 'required' }}>
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
                            <td><input type="number" step="0.01" name="total_subjects" class="input-field" placeholder="عدد المواد" {{ $isViewOnly ? 'disabled' : 'required' }}></td>
                            <td><input type="number" step="0.01" name="passed_subjects" class="input-field" placeholder="عدد المواد الناجح فيها" {{ $isViewOnly ? 'disabled' : 'required' }}></td>
                            <td><input type="number" step="0.01" name="failed_subjects" class="input-field" placeholder="عدد المواد الراسب فيها" {{ $isViewOnly ? 'disabled' : 'required' }}></td>
                            <td><input type="number" step="0.01" name="total" id="total" class="input-field" placeholder="المجموع" {{ $isViewOnly ? 'disabled' : 'required' }}></td>
                            <td><input type="number" step="0.01" name="overall_average" id="overall_average" class="input-field" placeholder="المعدل العام" {{ $isViewOnly ? 'disabled' : 'required' }}></td>
                            <td><input type="text" name="grade" id="grade" class="input-field" style="width: 70px;" placeholder="التقدير" {{ $isViewOnly ? 'disabled' : 'required' }}></td>
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

            <!-- Form Submission -->
            <div class="form-summary">
                @unless($isViewOnly)
                    <button type="submit" class="btn-primary">حفظ</button>
                @endunless
            </div>

            @if($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </form>
</body>
</html>
