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
            <nav>
                <ul>
                    <li><a href="{{ route('admin.index') }}"> الرئيسية</a></li>
                    <li class="active"><a href="{{ route('admin.manage') }}"> إدارة العملاء</a></li>
                    <li><a href="{{ route('admin.captains.index') }}"> إدارة الكباتن</a></li>
                    <li><a href="#"> جداول التمارين</a></li>
                    <li><a href="{{ route('diet_plans.index') }}"> الأنظمة الغذائية</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="form-container">
                <div class="form-header">
                    <h2>إضافة مشترك جديد</h2>
                    <p>قم بتعبئة بيانات المشترك لإنشاء حساب جديد</p>
                </div>
                @if ($errors->any())
                    <div
                        style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: right;">
                        <strong>عفواً، يوجد أخطاء في البيانات:</strong>
                        <ul style="margin-top: 10px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.storeclient') }}" method="POST" class="client-form">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">اسم المتدرب بالكامل</label>
                        <input type="text" class="form-input" placeholder="مثال: أحمد محمد علي" name="name"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-input" placeholder="example@mail.com" name="email"
                        value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">كلمة المرور</label>
                        <input type="password" class="form-input" placeholder="كلمة المرور (8 أرقام على الأقل)"
                            name="password" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="tel" class="form-input" placeholder="01xxxxxxxxx" name="phone"
                            value="{{ old('phone') }}" required>
                    </div>

                    <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

                    <div class="form-group">
                        <label class="form-label">اسم الباقة</label>
                        <input type="text" class="form-input" placeholder="مثال: باقة كمال أجسام شهرية"
                            name="name_plan" value="{{ old('name_plan') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">تاريخ بداية الاشتراك</label>
                        <input type="date" class="form-input" name="starts_at"
                            value="{{ old('starts_at', date('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">عدد أيام الاشتراك</label>
                        <input type="number" class="form-input" placeholder="مثال: 30" name="duration"
                            value="{{ old('duration') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">حالة الاشتراك</label>
                        <select class="form-select" name="status">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>نشط</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>منتهي / موقوف
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn-submit">تسجيل وإضافة العميل</button>
                </form>

                <a href="{{ route('admin.index') }}" class="back-link">← العودة للوحة التحكم</a>
            </div>
        </main>
    </div>
</body>

</html>
