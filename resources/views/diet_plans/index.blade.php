<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعيين الأنظمة الغذائية - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/workout/index.css') }}">
</head>

<body>
    <div class="dashboard-container">
        @include('layouts.sidebar')

        <main class="main-content">
            <header class="header-section">
                <div>
                    <h1>🥗 تعيين الأنظمة الغذائية</h1>
                    <p>اختر المتدرب والنظام الغذائي المناسب له</p>
                </div>
            </header>

            @if (session('success'))
                <div style="background-color: #198754; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="background-color: #dc3545; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-right: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="form-card">
                <h3>📋 نموذج التعيين</h3>
                <form action="{{ route('diet_plans.store') }}" method="POST" class="client-form">
                    @csrf

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; color: #aaa; margin-bottom: 8px; font-size: 14px;">اختيار المتدرب</label>
                        <select name="subscription_id" required style="width: 100%; height: 50px; background: #1a1a1a; color: white; border: 1px solid #333; padding: 10px 15px; border-radius: 8px; font-family: inherit; font-size: 15px;">
                            <option value="" disabled selected>-- اختر المتدرب --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->subscription->id }}">
                                    {{ $user->name }} (باقة: {{ $user->subscription->name ?? 'غير محدد' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; color: #aaa; margin-bottom: 8px; font-size: 14px;">اختيار النظام الغذائي</label>
                        <select name="diet_plan_id" required style="width: 100%; height: 50px; background: #1a1a1a; color: white; border: 1px solid #333; padding: 10px 15px; border-radius: 8px; font-family: inherit; font-size: 15px;">
                            <option value="" disabled selected>-- اختر النظام الغذائي --</option>
                            @foreach($dietPlans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; color: #aaa; margin-bottom: 8px; font-size: 14px;">ملاحظات إضافية (اختياري)</label>
                        <textarea name="custom_notes" placeholder="أضف أي ملاحظات خاصة بهذا المتدرب..." class="workout-textarea" style="width: 100%; min-height: 100px; padding: 20px;">{{ old('custom_notes') }}</textarea>
                    </div>

                    <div class="actions-bar">
                        <button type="submit" class="btn-save" style="width: 100%;">💾 تعيين النظام الآن</button>
                    </div>
                </form>
            </section>

        </main>
    </div>
</body>

</html>
