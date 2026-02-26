<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد | GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/Admin/login/register.css')
</head>

<body>

    <div class="register-container">
        <div class="register-card">
            <div class="logo">GYM CORE</div>

            <div class="register-header">
                <h2>إنشاء حساب جديد</h2>
                <p>انضم إلينا الآن وابدأ رحلتك الرياضية!</p>
            </div>

            @if ($errors->any())
                <div class="error-messages">
                    <strong>عفواً، راجع الأخطاء التالية:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf <div class="form-group">
                    <label>الاسم بالكامل</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="مثال: أحمد محمد" required>
                </div>

                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="01xxxxxxxxx" required>
                </div>

                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com" required>
                </div>

                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label>تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-register">تسجيل الحساب</button>
            </form>

            <div class="login-link">
                لديك حساب بالفعل؟ <a href="{{ route('show.login') }}">تسجيل الدخول من هنا</a>
            </div>
        </div>
    </div>

</body>

</html>
