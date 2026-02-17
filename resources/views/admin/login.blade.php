<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول | GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
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
            /* خلفية بسيطة تعطي لمسة رياضية خفيفة (اختياري) */
            background-image: radial-gradient(circle at 50% 0%, #1a1a1a 0%, #121212 70%);
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-card {
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

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .login-header p {
            color: var(--text-gray);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
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

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-gray);
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            cursor: pointer;
            width: 16px;
            height: 16px;
            accent-color: var(--primary-blue);
        }

        .forgot-password {
            color: var(--primary-blue);
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: #3395ff;
            text-decoration: underline;
        }

        .btn-login {
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
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .btn-login:active {
            transform: scale(0.98);
        }

        /* رسالة خطأ وهمية للتجربة */
        .error-message {
            background-color: rgba(220, 53, 69, 0.1);
            color: #ff4d4d;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            text-align: center;
            margin-bottom: 20px;
            border: 1px solid rgba(220, 53, 69, 0.3);
            display: none; /* غيرها لـ block عشان تشوف شكلها */
        }
    </style>
</head>

<body>

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
            <form action=" method="POST">
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
