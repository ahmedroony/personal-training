<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل المتدرب | {{ $user->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/Admin/index.css')
    <style>
        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        .info-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .info-card h2 {
            color: var(--primary);
            font-size: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .info-item {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .info-label { color: var(--muted); font-size: 14px; }
        .info-value { font-weight: 600; color: #fff; }
        .content-box {
            background: #161616;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid var(--border);
            margin-top: 10px;
            white-space: pre-wrap;
            font-size: 14px;
            line-height: 1.6;
            color: #ccc;
        }
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            text-decoration: none;
            margin-bottom: 20px;
            transition: 0.3s;
        }
        .back-btn:hover { color: var(--primary); }
    </style>
</head>
<body>
    <div class="app-wrapper">
        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            <nav class="nav-links">
                <a href="{{ route('admin.index') }}">الرئيسية</a>
                <a href="{{ route('admin.manage') }}">إدارة العملاء</a>
                <a href="{{ route('admin.captains.index') }}">إدارة الكباتن</a>
                <a href="{{ route('workout.index') }}">جداول التمارين</a>
                <a href="{{ route('diet_plans.index') }}">الأنظمة الغذائية</a>
            </nav>
        </aside>

        <main class="main-content">
            <a href="{{ route('admin.index') }}" class="back-btn">← العودة للوحة التحكم</a>

            <header style="margin-bottom: 30px;">
                <h1>ملف المتدرب: {{ $user->name }}</h1>
                <p style="color: var(--muted);">عرض شامل لجميع بيانات المتدرب واشتراكاته</p>
            </header>

            <div class="details-grid">
                <!-- البيانات الشخصية والاختراك -->
                <div class="info-card">
                    <h2>👤 البيانات الأساسية</h2>
                    <div class="info-item">
                        <span class="info-label">رقم الهاتف:</span>
                        <span class="info-value">{{ $user->phone_number }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">البريد الإلكتروني:</span>
                        <span class="info-value">{{ $user->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">اسم الباقة:</span>
                        <span class="info-value">{{ $user->subscription->name_plan ?? 'بدون باقة' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">سعر الباقة:</span>
                        <span class="info-value">{{ $user->subscription->price ?? 0 }} ج.م</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">تاريخ البدء:</span>
                        <span class="info-value">{{ $user->subscription?->starts_at?->format('Y-m-d') ?? '--' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">تاريخ الانتهاء:</span>
                        <span class="info-value">{{ $user->subscription?->ends_at?->format('Y-m-d') ?? '--' }}</span>
                    </div>
                </div>

                <!-- جدول التمارين -->
                <div class="info-card">
                    <h2>🏋️ جدول التمارين</h2>
                    <div class="info-item">
                        <span class="info-label">وصف التدريب:</span>
                    </div>
                    <div class="content-box">
                        {{ $user->subscription->description ?? 'لا يوجد جدول تمارين محدد بعد' }}
                    </div>
                </div>

                <!-- الأنظمة الغذائية -->
                <div class="info-card" style="grid-column: 1 / -1;">
                    <h2>🥗 الأنظمة الغذائية (أحدث الخطط)</h2>
                    @if($user->dietPlans)
                        @foreach($user->dietPlans as $plan)
                            <div style="margin-bottom: 20px;">
                                <div class="content-box">
                                    {{ $plan->description }}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p style="color: var(--muted); text-align: center; padding: 20px;">لم يتم تعيين نظام غذائي لهذا المشترك بعد.</p>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>
