<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة عميل جديد - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    @vite('resources/css/Captain/create.css');
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
                        <label>اضافه باقه</label>
                        <input type="text" name="package_name" required>
                    </div>

                    <div class="form-group">
                        <label>رقم الهاتف</label>
                        <input type="tel" name="phone_number" placeholder="01xxxxxxxxx">
                    </div>
                    <div class="form-group">
                        <label>تاريخ بداية الاشتراك</label>
                        <input type="date"  required name="subscription_starts_at">
                    </div>

                    <div class="form-group">
                        <label>تاريخ نهاية الاشتراك</label>
                        <input type="date"  required name="subscription_ends_at">
                    </div>

                    <div class="form-group">
                        <label>عدد أيام الاشتراك</label>
                        <input type="number" name="duration_days" placeholder="مثال: 30" required>
                    </div>


                    <button type="submit" class="btn-submit">تأجيل وإضافة العميل</button>
                </form>

                <a href="#" class="back-link">← العودة للوحة التحكم</a>
            </div>
        </main>
    </div>

</body>

</html>
