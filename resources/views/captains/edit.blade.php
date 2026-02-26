<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل بيانات الكابتن - GYM CORE</title>
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
            background: #ffc107;
            color: #000;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
        }
        .btn-submit:hover {
            background: #e0a800;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #ccc;
            text-decoration: none;
        }
        .notice {
            font-size: 12px;
            color: #dc3545;
            margin-top: -10px;
            margin-bottom: 15px;
            display: block;
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
                    <h2>✏️ تعديل بيانات الكابتن</h2>
                    <p style="color: #aaa;">تحديث بيانات الكابتن: {{ $captain->name }}</p>
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

                <form method="POST" action="{{ route('admin.captains.update', $captain->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>اسم الكابتن بالكامل</label>
                        <input type="text" name="name" value="{{ old('name', $captain->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email', $captain->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label>رقم الهاتف</label>
                        <input type="tel" name="phone_number" value="{{ old('phone_number', $captain->phone_number) }}" required>
                    </div>

                    <div class="form-group">
                        <label>كلمة المرور الجديدة (اختياري)</label>
                        <input type="password" name="password" placeholder="اترك الحقل فارغاً إذا لم ترد تغيير كلمة المرور">
                        <span class="notice">* إذا قمت بكتابة كلمة مرور هنا سيتم تغيير كلمة مرور الكابتن السابقة.</span>
                    </div>

                    <button type="submit" class="btn-submit">💾 حفظ التعديلات</button>
                </form>
                <a href="{{ route('admin.captains.index') }}" class="back-link">← إلغاء وعودة للقائمة</a>
            </div>
        </main>
    </div>
</body>

</html>
