<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة عميل جديد - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #121212;
            --sidebar-bg: #1e1e1e;
            --primary-blue: #007bff;
            --text-white: #ffffff;
            --text-gray: #b3b3b3;
            --border-color: #333;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Cairo', sans-serif; }
        body { background-color: var(--bg-dark); color: var(--text-white); }

        .dashboard-container { display: flex; min-height: 100vh; }

        /* Sidebar (نفس استايل الصفحة الرئيسية) */
        .sidebar { width: 260px; background-color: var(--sidebar-bg); padding: 20px; display: flex; flex-direction: column; border-left: 1px solid var(--border-color); }
        .sidebar .logo { font-size: 24px; font-weight: bold; color: var(--primary-blue); margin-bottom: 40px; text-align: center; }

        /* Main Content */
        .main-content { flex: 1; padding: 40px; display: flex; justify-content: center; }

        .form-container {
            width: 100%;
            max-width: 600px;
            background-color: var(--sidebar-bg);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .form-header { margin-bottom: 30px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; }
        .form-header h2 { font-size: 24px; color: var(--primary-blue); }
        .form-header p { color: var(--text-gray); font-size: 14px; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: var(--text-gray); font-weight: bold; }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            background-color: #2a2a2a;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: white;
            outline: none;
            transition: 0.3s;
        }

        .form-group input:focus { border-color: var(--primary-blue); }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background-color: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover { background-color: #0056b3; transform: translateY(-2px); }

        .back-link { display: inline-block; margin-top: 20px; color: var(--text-gray); text-decoration: none; font-size: 14px; }
        .back-link:hover { color: var(--primary-blue); }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            <nav>
                <p style="color: var(--text-gray); text-align: center;">لوحة تحكم الكابتن</p>
            </nav>
        </aside>

        <main class="main-content">
            @if ($errors->any())
                <div style="background-color: #ff4d4d; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <ul style="list-style: none; color: white;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-container">
                <div class="form-header">
                    <h2>إضافة عميل جديد</h2>
                    <p>أدخل بيانات المتدرب لإنشاء حساب وربطه بباقة تدريبية.</p>
                </div>

                <form action="{{ route('captain.store') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label>اسم المتدرب بالكامل</label>
                        <input type="text" name="name" placeholder="مثال: أحمد محمد علي" required>
                    </div>

                    <div class="form-group">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" placeholder="example@mail.com" required>
                    </div>

                    <div class="form-group">
                        <label>اختر الباقة المشترك بها</label>
                        <select name="package_id" required>
                            <option value="">-- اختر من الباقات المتاحة --</option>
                            <option value="1">باقة التضخيم (3 شهور)</option>
                            <option value="2">باقة التنشيف (شهر)</option>
                            <option value="3">VIP التدريب الخاص</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>رقم الهاتف</label>
                        <input type="tel" name="phone_number" placeholder="01xxxxxxxxx">
                    </div>

                    <button type="submit" class="btn-submit">تأجيل وإضافة العميل</button>
                </form>

                <a href="#" class="back-link">← العودة للوحة التحكم</a>
            </div>
        </main>
    </div>

</body>
</html>
