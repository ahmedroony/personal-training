<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة المتدرب | GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/client.css') }}">
</head>
<body>
    <div class="app-wrapper">

        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            <nav class="nav-links">
                <a href="{{ route('client.dashboard') }}" class="active">🏠 الرئيسية</a>
            </nav>
            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">🚪 تسجيل الخروج</button>
                </form>
            </div>
        </aside>

        <main class="main-content">

                <header class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h1>مرحباً، {{ $user->name ?? 'مستدرب' }} 👋</h1>
                        <p>إليك نظرة سريعة على حالتك الرياضية</p>
                    </div>

                    @if(session('success'))
                        <div style="color: #28a745; background: rgba(40,167,69,0.1); padding: 10px 15px; border-radius: 8px;">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div style="color: #dc3545; background: rgba(220,53,69,0.1); padding: 10px 15px; border-radius: 8px;">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('client.checkin') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn" style="background: #28a745; border: none; color: white;">✅ تسجيل حضور اليوم</button>
                    </form>
                </header>

            @php
                $sub = $user->subscription ?? null;
            @endphp

            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">📦</div>
                    <div>
                        <p class="stat-label">اسم الباقة</p>
                        <p class="stat-value">{{ $sub?->plan?->name ?? 'لا توجد باقة' }}</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">⏳</div>
                    <div>
                        <p class="stat-label">الأيام المتبقية</p>
                        <p class="stat-value">{{ $sub?->remaining_days ?? 0 }} يوم</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">{{ ($sub && $sub->is_active) ? '✅' : '❌' }}</div>
                    <div>
                        <p class="stat-label">حالة الاشتراك</p>
                        <p class="stat-value" style="color: {{ ($sub && $sub->is_active) ? '#28a745' : '#dc3545' }}">
                            {{ ($sub && $sub->is_active) ? 'نشط' : 'منتهي' }}
                        </p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📅</div>
                    <div>
                        <p class="stat-label">تاريخ الانتهاء</p>
                        <p class="stat-value">{{ $sub?->end_date?->format('Y-m-d') ?? 'غير محدد' }}</p>
                    </div>
                </div>
            </section>

            <div class="two-col">

                <section class="section-card">
                    <h2>📅 سجل الحضور</h2>
                    @if($sub && $sub->attendances->count() > 0)
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>التاريخ</th>
                                    <th>الوقت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sub->attendances as $i => $att)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $att->date->format('Y-m-d') }}</td>
                                        <td>{{ $att->time }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">
                            <span>📭</span>
                            <p>لا يوجد سجل حضور حالياً</p>
                        </div>
                    @endif
                </section>

                <section class="section-card">
                    <h2>🥗 النظام الغذائي</h2>
                    @php $latestDiet = $sub?->diets?->last(); @endphp
                    @if($latestDiet)
                        <div class="diet-box">
                            <p class="diet-name">{{ $latestDiet->dietPlan->name }}</p>
                            <p class="diet-desc">{{ $latestDiet->dietPlan->base_description }}</p>
                            @if($latestDiet->custom_notes)
                                <div class="diet-notes">
                                    <strong>ملاحظات الكابتن:</strong>
                                    <p>{{ $latestDiet->custom_notes }}</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="empty-state">
                            <span>🍽️</span>
                            <p>لم يتم تعيين نظام غذائي بعد</p>
                        </div>
                    @endif
                </section>

            </div>

            <section class="section-card" style="margin-top: 1.5rem;">
                <h2>🏋️ جدول التمارين</h2>
                @if($sub && $sub->plan && $sub->plan->description)
                    <div style="background: rgba(255,255,255,0.05); border-radius: 10px; padding: 1.5rem; border-right: 4px solid #6c63ff; margin-top: 1rem;">
                        <p style="color: #fff; font-size: 1rem; line-height: 1.6; white-space: pre-line;">{{ $sub->plan->description }}</p>
                    </div>
                @else
                    <div class="empty-state">
                        <span>🏋️</span>
                        <p>لا يوجد جدول تمارين مخصص لهذه الباقة حالياً</p>
                    </div>
                @endif
            </section>

        </main>
    </div>
</body>
</html>
