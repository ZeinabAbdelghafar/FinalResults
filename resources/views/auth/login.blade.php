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
        max-width: 500px;
        margin: 30px auto;
    }
    .form-label {
        text-align: right;
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 15px;
    }
    .form-error {
        color: red;
        margin-bottom: 10px;
        display: block;
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
        width: 100%;
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
    .remember-me {
        margin-bottom: 15px;
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
            max-width: 100%;
            box-sizing: border-box;
        }
        button {
            font-size: 12pt;
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
    
    <h2>تسجيل دخول المشرف</h2>
    
    <div class="form-container">
        @if (session('status'))
            <div style="color: green; margin-bottom: 15px;">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="form-error">{{ $message }}</span>
            @enderror

            <label for="password" class="form-label">كلمة المرور</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror

            <div class="remember-me">
                <label>
                    <input type="checkbox" name="remember"> تذكرني
                </label>
            </div>

            <button type="submit">تسجيل الدخول</button>
        </form>
    </div>
</body>
