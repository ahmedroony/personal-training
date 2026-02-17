<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد | GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* الستايل زي ما هو بالظبط بدون تغيير */
        :root {
            --bg-dark: #121212;
            --card-bg: #1e1e1e;
            --primary-blue: #007bff;
            --text-white: #ffffff;
            --text-gray: #b3b3b3;
            --border-color: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-white);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: radial-gradient(circle at 50% 0%, #1a1a1a 0%, #121212 70%);
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 450px;
        }

        .register-card {
            background-color: var(--card-bg);
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-color);
        }

        .logo {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-blue);
            text-align: center;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .register-header p {
            color: var(--text-gray);
            font-size: 14px;
        }

        /* تنسيق رسائل الخطأ */
        .error-messages {
            background-color: rgba(220, 53, 69, 0.1);
            color: #ff4d4d;
            padding: 15px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }
        .error-messages ul {
            padding-right: 20px;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-gray);
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            background-color: #2a2a2a;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: white;
            font-size: 15px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: var(--primary-blue);
            background-color: #333;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.1s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background-color: #0056b3;
        }

        .btn-register:active {
            transform: scale(0.98);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: var(--text-gray);
        }

        .login-link a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #3395ff;
            text-decoration: underline;
        }
    </style>
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
