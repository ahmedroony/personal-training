<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة مشترك جديد - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/admin/create.css')
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            </aside>

        <main class="main-content">
            <div class="form-container">
                <div class="form-header">
                    <h2>إضافة مشترك جديد</h2>
                    <p>قم بتعبئة بيانات المشترك لإنشاء حساب جديد</p>
                </div>

                <form action="{{ route('admin.storeclient') }}" method="POST" class="client-form">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">اسم المتدرب بالكامل</label>
                        <input type="text" class="form-input" placeholder="مثال: أحمد محمد علي" name="name">
                    </div>

                    <div class="form-group">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-input" placeholder="example@mail.com" name="email">
                    </div>

                    <div class="form-group">
                        <label class="form-label">كلمة المرور</label>
                        <input type="password" class="form-input" placeholder="كلمة المرور" name="password">
                    </div>

                    <div class="form-group">
                        <label class="form-label">الباقة</label>
                        <input type="package" class="form-input" placeholder="مثال: باقة شهرية" name="package">
                    </div>

                    <div class="form-group">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="tel" class="form-input" placeholder="01xxxxxxxxx" name="phone">
                    </div>

                    <div class="form-group">
                        <label class="form-label">تاريخ بداية الاشتراك</label>
                        <input type="date" class="form-input" name="start_date">
                    </div>


                    <div class="form-group">
                        <label class="form-label">عدد أيام الاشتراك</label>
                        <input type="number" class="form-input" placeholder="مثال: 30" name="days">
                    </div>

                    <div class="form-group">
                        <label class="form-label">حالة الاشتراك</label>
                        <select class="form-select" name="status">
                            <option value="active" selected>نشط</option>
                            <option value="inactive">منتهي</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-submit">تسجيل وإضافة العميل</button>
                </form>
                <a href="#" class="back-link">← العودة للوحة التحكم</a>
            </div>
        </main>
    </div>
</body>

</html>
