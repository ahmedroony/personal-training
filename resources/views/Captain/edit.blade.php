<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل بيانات العميل - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/Captain/edit.css');
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            <nav>
                <p style="color: #6c757d; text-align: center; margin-bottom: 15px; font-size: 13px;">لوحة التحكم</p>
                <ul>
                    <li><a href="#">🏠 الرئيسية</a></li>
                    <li><a href="#" class="active">👥 إدارة العملاء</a></li>
                    <li><a href="#">📊 التقارير</a></li>
                    <li><a href="#">⚙️ الإعدادات</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="form-container">
                <div class="form-header">
                    <h2>✏️ تعديل بيانات العميل</h2>
                    <p>قم بتحديث البيانات واضغط حفظ لتأكيد التغييرات.</p>
                </div>
                @if ($errors->any())
                    <div
                        style="background-color: #dc3545; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                        <ul style="margin: 0; padding-right: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('captain.update', $client->id) }}">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label>اسم المتدرب بالكامل</label>
                        <input type="text" name="name" value="{{ old('name', $client->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email', $client->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label>اسم الباقة</label>
                        <input type="text" name="package_name"
                            value="{{ old('package_name', $client->package_name ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label>رقم الهاتف</label>
                        <input type="tel" name="phone_number"
                            value="{{ old('phone_number', $client->phone_number) }}" required>
                    </div>

                    <div class="form-group">
                        <label>تاريخ بداية الاشتراك</label>
                        <input type="date" name="subscription_starts_at"
                            value="{{ old('subscription_starts_at', $client->subscription_starts_at->format('Y-m-d')) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>عدد أيام الباقة</label>
                        <input type="number" name="duration_days"
                            value="{{ old('duration_days', $client->duration_days) }}" min="1" required>
                    </div>

                    {{-- ✅ تاريخ النهاية بيتحسب تلقائي مش محتاج حقل --}}
                    <p style="color: gray; font-size: 14px;">
                        📅 تاريخ نهاية الاشتراك الحالي:
                        {{ $client->subscription_ends_at->format('Y-m-d') }}
                        (هيحدث تلقائي)
                    </p>

                    <button type="submit" class="btn-submit">💾 حفظ التعديلات</button>
                </form>

                <a href="{{ route('captain.index') }}" class="back-link">← إلغاء وعودة للقائمة</a>
            </div>
        </main>
    </div>
</body>

</html>
