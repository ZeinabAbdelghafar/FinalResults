@section('styles')
<style>
    body {
        font-family: 'Markazi Text';
        font-size: 15pt;
        direction: rtl;
        background-color: #fff;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #0f264f;
        height: 15%;
    }
    #banner-right, #banner-left, #banner-center {
        flex: 1;
        text-align: center;
    }
    #ImageLogoRight, #ImageLogoLeft, #ImageLogoMiddle {
        width: auto;
        height: 100%;
    }
    .form-container {
        background-color: #f0f3f8;
        padding: 50px;
        border-radius: 8px;
        border: 1px solid grey;
    }
    .form1 {
        display: grid;
        grid-template-columns: 1fr 2fr 2fr 1fr;
        align-items: center;
        gap: 10px;
    }
    .form-label {
        text-align: right;
        margin-left: 5%;
    }
    .form-control {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .form-error {
        color: red;
        margin-right: 10px;
        text-align: left;
    }
    button {
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
    button:hover {
        background-color: #ccc;
    }
    h2 {
        font: 15pt Trebuchet MS, Lucida Grande, Lucida Sans Unicode;
        font-weight: bold;
        text-align: center;
        margin-top: 20px;
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
            padding: 20px;
        }
        .form1 {
            grid-template-columns: 1fr;
            gap: 5px;
        }
        .form-label {
            margin-left: 0;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .form-error {
            margin-right: 0;
            text-align: right;
        }
        button {
            width: 100%;
            font-size: 12pt;
            margin-top: 10px;
        }
    }
</style>

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
    <h2>نتائج امتحانات شهادتي إتمام مرحلتي التعليم الأساسي والثانوي للعام الدراسي {{ $academicYear ?? '2024 / 2025' }}</h2>
    
    <div class="form-container">
        <form action="{{ route('students.showCertification') }}" method="POST" class="form1">
            @csrf
            
            <!-- Seat Number Group -->
            <label for="seat_number" class="form-label">رقم الجلوس</label>
            <input type="text" class="form-control" id="seat_number" name="seat_number">
            @if ($errors->has('seat_number'))
                <span class="form-error">{{ $errors->first('seat_number') }}</span>
            @else
                <span></span>
            @endif
            
            <!-- Empty space for the button, but nothing in this row yet -->
            <div></div>
            
            <!-- Registration Number Group -->
            <label for="registration_number" class="form-label">رقم القيد</label>
            <input type="text" class="form-control" id="registration_number" name="registration_number">
            @if ($errors->has('registration_number'))
                <span class="form-error">{{ $errors->first('registration_number') }}</span>
            @else
                <span></span>
            @endif
            
            <!-- Submit button (only placed in the left column) -->
            <button type="submit">عرض الدرجات</button>
        </form>
    </div>
</body>
