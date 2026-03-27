<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل بيانات العميل - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/Admin/edit.css');
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
                    <li><a href="{{ route('workout.index') }}"> جداول التمارين</a></li>
                    <li><a href="{{ route('diet_plans.index') }}"> الأنظمة الغذائية</a></li>
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

                <form method="POST" action="{{ route('admin.updateClient', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>اسم المتدرب بالكامل</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label>رقم الهاتف</label>
                        <input type="tel" name="phone_number"
                            value="{{ old('phone_number', $user->phones->first()->number ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label>اختر الباقة</label>
                        <select name="plan_id" required>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}" {{ old('plan_id', $user->subscription->plan_id ?? '') == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }} ({{ $plan->duration_days }} يوم)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>تاريخ الانتهاء</label>
                        <input type="date" name="end_date"
                            value="{{ old('end_date', $user->subscription?->end_date?->format('Y-m-d') ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>السعر المدفوع (جنيه) - [ثابت لتعاقد العميل القديم]</label>
                        <input type="number" step="0.01" name="price"
                            value="{{ old('price', $user->subscription->paid_price ?? 0) }}" readonly style="background-color: #333; cursor: not-allowed; color:#888;">
                    </div>
                    <button type="submit" class="btn-submit">💾 حفظ التعديلات</button>
                </form>
                <a href="{{ route('admin.index') }}" class="back-link">← إلغاء وعودة للقائمة</a>
            </div>
        </main>
    </div>
</body>

</html>
