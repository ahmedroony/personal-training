<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل بيانات الكابتن - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/captains/form.css')
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            <nav>
                <ul>
                    <li><a href="{{ route('admin.index') }}"> الرئيسية</a></li>
                    <li><a href="{{ route('admin.manage') }}"> إدارة العملاء</a></li>
                    <li class="active"><a href="{{ route('admin.captains.index') }}"> إدارة الكباتن</a></li>
                    <li><a href="#"> جداول التمارين</a></li>
                    <li><a href="#"> الأنظمة الغذائية</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="form-container">
                <div class="form-header">
                    <h2>✏️ تعديل بيانات الكابتن</h2>
                    <p>تحديث بيانات الكابتن: {{ $captain->name }}</p>
                </div>

                @if ($errors->any())
                    <div style="background-color: #dc3545; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                        <ul style="margin: 0; padding-right: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.captains.update', $captain->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>اسم الكابتن بالكامل</label>
                        <input type="text" name="name" value="{{ old('name', $captain->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email', $captain->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label>رقم الهاتف</label>
                        <input type="tel" name="phone_number" value="{{ old('phone_number', $captain->phone_number) }}" required>
                    </div>

                    <div class="form-group">
                        <label>كلمة المرور الجديدة (اختياري)</label>
                        <input type="password" name="password" placeholder="اترك الحقل فارغاً إذا لم ترد تغيير كلمة المرور">
                        <span class="notice">* إذا قمت بكتابة كلمة مرور هنا سيتم تغيير كلمة مرور الكابتن السابقة.</span>
                    </div>

                    <button type="submit" class="btn-submit btn-submit-edit">💾 حفظ التعديلات</button>
                </form>
                <a href="{{ route('admin.captains.index') }}" class="back-link">← إلغاء وعودة للقائمة</a>
            </div>
        </main>
    </div>
</body>

</html>
