<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة كابتن جديد - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/Admin/edit.css')
    <style>
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            background: #111;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            border: 1px solid #333;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #ddd;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            background: #222;
            border: 1px solid #444;
            color: #fff;
            border-radius: 5px;
        }
        .btn-submit {
            background: #0d6efd;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
        }
        .btn-submit:hover {
            background: #0b5ed7;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #ccc;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            <nav>
                <ul>
                    <li><a href="{{ route('admin.index') }}"> الرئيسية</a></li>
                    <li><a href="{{ route('admin.manage') }}"> إدارة العملاء</a></li>
                    <li class="active"><a href="{{ route('admin.captains.index') }}"> إدارة الكباتن</a></li>
                    <li><a href="#"> جداول التمارين</a></li>
                    <li><a href="#"> الأنظمة الغذائية</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="form-container">
                <div class="form-header" style="text-align: center; margin-bottom: 20px;">
                    <h2>💪 إضافة كابتن (مدرب) جديد</h2>
                    <p style="color: #aaa;">أدخل بيانات المدرب الجديد لإنشاء حسابه</p>
                </div>

                @if ($errors->any())
                    <div style="background-color: #dc3545; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                        <ul style="margin: 0; padding-right: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.captains.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>اسم الكابتن بالكامل</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="مثال: كابتن أحمد">
                    </div>

                    <div class="form-group">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="captain@gym.com">
                    </div>

                    <div class="form-group">
                        <label>رقم الهاتف</label>
                        <input type="tel" name="phone_number" value="{{ old('phone_number') }}" required placeholder="01234567890">
                    </div>

                    <div class="form-group">
                        <label>كلمة المرور</label>
                        <input type="password" name="password" required placeholder="كلمة مرور للدخول للوحة الكابتن (8 أحرف على الأقل)">
                    </div>

                    <button type="submit" class="btn-submit">➕ إضافة الكابتن</button>
                </form>
                <a href="{{ route('admin.captains.index') }}" class="back-link">← إلغاء وعودة للقائمة</a>
            </div>
        </main>
    </div>
</body>

</html>
