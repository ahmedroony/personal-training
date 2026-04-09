<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خطأ في النظام - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0a0a;
            --primary: #c9ff00;
            --text: #ffffff;
            --muted: #888;
        }
        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }
        .container {
            padding: 30px;
            max-width: 500px;
        }
        .icon {
            font-size: 80px;
            margin-bottom: 20px;
            display: block;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        p {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .btn {
            background-color: var(--primary);
            color: #000;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
            display: inline-block;
        }
        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(201, 255, 0, 0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <span class="icon">🏋️‍♂️</span>
        <h1>عفواً، حدث خطأ غير متوقع!</h1>
        <p>نواجه حالياً مشكلة تقنية بسيطة. جاري العمل على حلها بواسطة فريقنا الفني.</p>
        <a href="{{ url('/') }}" class="btn">العودة للرئيسية</a>
</body>
</html>
