<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة مشترك جديد - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Admin/create.css') }}">
</head>

<body>
    <div class="dashboard-container">
        @include('layouts.sidebar')

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
                        <label class="form-label">اختر باقة موجودة</label>
                        <select name="plan_id" class="form-input">
                            <option value="">-- أو قم بإضافة باقة جديدة بالأسفل --</option>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->name }} ({{ $plan->duration_days }} يوم)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">اسم الباقة الجديدة</label>
                        <input type="text" class="form-input" placeholder="مثال: باقة كمال أجسام شهرية"
                            name="name_plan" value="{{ old('name_plan') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">عدد أيام الاشتراك</label>
                        <input type="number" class="form-input" placeholder="مثال: 30" name="duration"
                            value="{{ old('duration') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">تاريخ بداية الاشتراك</label>
                        <input type="date" class="form-input" name="starts_at"
                            value="{{ old('starts_at', date('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">تاريخ نهاية الاشتراك (اختياري - يحسب تلقائياً إذا ترك فارغاً)</label>
                        <input type="date" class="form-input" name="end_date"
                            value="{{ old('end_date') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">المبلغ المدفوع (يترك فارغاً لاعتماده من الباقة)</label>
                        <input type="number" step="0.01" class="form-input" placeholder="مثال: 500" name="price"
                            value="{{ old('price') }}">
                    </div>

                    <button type="submit" class="btn-submit">تسجيل وإضافة العميل</button>
                </form>

                <a href="{{ route('admin.index') }}" class="back-link">← العودة للوحة التحكم</a>
            </div>
        </main>
    </div>
</body>

</html>
