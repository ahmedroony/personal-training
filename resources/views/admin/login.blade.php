<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول | GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/Admin/login/login.css')
</head>
<body>
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
    <div class="login-container">
        <div class="login-card">
            <div class="logo">GYM CORE</div>

            <div class="login-header">
                <h2>تسجيل الدخول</h2>
                <p>أهلاً بك مجدداً! أدخل بياناتك للمتابعة.</p>
            </div>

            <div class="error-message">
                البريد الإلكتروني أو كلمة المرور غير صحيحة.
            </div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" placeholder="admin@gym.com" required name="email">
                </div>

                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" placeholder="••••••••" required name="password">
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> تذكرني
                    </label>
                    <a href="#" class="forgot-password">نسيت كلمة المرور؟</a>
                </div>

                <button type="submit" class="btn-login">دخول للوحة التحكم</button>
            </form>
        </div>
    </div>

</body>

</html>
