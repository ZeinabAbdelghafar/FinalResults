<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة الطلاب</title>
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
        .container {
            max-width: 90%;
            margin: 25px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .page-title {
            text-align: center;
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
            width: 90%;
            margin: 0px auto;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        #students-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }
        .student-card {
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            width: 300px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .student-card:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .student-header {
            margin-bottom: 15px;
        }
        .student-header h3 {
            margin: 0;
            font-size: 16px;
            color: #34495e;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .student-header p {
            margin: 0;
            font-size: 14px;
            color: #7f8c8d;
        }
        .actions {
            margin-top: 10px;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            font-size: 14px;
            text-decoration: none;
            border-radius: 5px;
            color: #fff;
            margin: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }
        .btn-view {
            background-color: #2ecc71;
        }
        .btn-edit {
            background-color: #ffc107;
            color: black;
        }
        .btn-delete {
            background-color: #e74c3c;
            border: none;
        }
        .btn-view:hover {
            background-color: #27ae60;
            color: #fff;
        }
        .btn-edit:hover {
            background-color: #e0a800;
            color: black;
        }
        .btn-delete:hover {
            background-color: #c0392b;
            color: #fff;
        }
        .btn-add {
            position: fixed;
            bottom: 40px;
            right: 30px;
            background-color: #3498db;
            color: #fff;
            padding: 25px 35px;
            font-size: 30px;
            text-align: center;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-add:hover {
            background-color: #2980b9;
            color: #fff;
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
        .top-actions {
            text-align: left;
            margin-bottom: 15px;
        }
        
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
            .container {
                margin: 15px;
                padding: 1rem;
            }
            .student-card {
                width: 100%;
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
    
    <h2>قائمة الطلاب - نتائج امتحانات شهادتي إتمام مرحلتي التعليم الأساسي والثانوي</h2>

    <div class="container">
        <div class="top-actions">
            <a href="{{ route('students.create') }}" class="btn btn-view">إضافة طالب جديد</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">تسجيل الخروج</button>
            </form>
        </div>

        <h1 class="page-title">البحث عن طالب</h1>

        <div class="form-group">
            <label for="search">البحث بالاسم أو رقم الجلوس:</label>
            <input type="text" id="search" name="search" class="form-control" placeholder="أدخل الاسم أو رقم الجلوس">
        </div>

        <div id="students-list">
            @foreach ($students as $student)
                <div class="student-card">
                    <div class="student-header">
                        <h3>{{ $student->student_name }}</h3>
                        <p>رقم الجلوس: {{ $student->seat_number }}</p>
                    </div>
                    <div class="actions">
                        <a href="{{ route('students.show', Crypt::encrypt($student->id)) }}" class="btn btn-view">عرض</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-edit">تعديل</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">حذف</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('students.create') }}" class="btn-add">+</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');

            searchInput.addEventListener('keyup', async function(event) {
                const query = event.target.value.trim();
                try {
                    const response = await fetch(`/search?query=${query}`);
                    const data = await response.json();
                    const studentsList = document.getElementById('students-list');
                    studentsList.innerHTML = '';
                    data.forEach((student) => {
                        studentsList.innerHTML += `
                        <div class="student-card">
                            <div class="student-header">
                                <h3>${student.student_name}</h3>
                                <p>رقم الجلوس: ${student.seat_number}</p>
                            </div>
                            <div class="actions">
                                <a href="/student/${student.hashedId}" class="btn btn-view">عرض</a>
                                <a href="/admin/${student.id}/edit" class="btn btn-edit">تعديل</a>
                                <form action="/admin/${student.id}" method="POST" style="display:inline;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-delete">حذف</button>
                                </form>
                            </div>
                        </div>
                        `;
                    });
                    if (data.length === 0) {
                        studentsList.innerHTML = '<p>لا يوجد طلاب</p>';
                    }
                } catch (error) {
                    console.error('Search error:', error);
                }
            });
        });
    </script>
</body>
</html>
