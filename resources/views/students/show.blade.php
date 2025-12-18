@include('students.certification-form', ['academicYear' => $student->academic_year ?? '2024 / 2025'])

<style>
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        font-family: Arial, sans-serif;
        background-color: #fff;
        font-family: 'Markazi Text';
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
    td{
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
    .qr-note h3 {
        font-size: 16px;
    }
    @media (max-width: 768px) {
        .form-container {
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

<div dir="rtl" class="form-container">
    @csrf
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
            <th>درجة النجاح في المادة	</th>
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
</div>