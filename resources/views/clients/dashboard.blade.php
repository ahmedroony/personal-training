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

        {{-- Sidebar --}}
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

        {{-- Main --}}
        <main class="main-content">

            <header class="page-header">
                <div>
                    <h1>مرحباً، {{ $user->name ?? 'مستدرب' }} 👋</h1>
                    <p>إليك نظرة سريعة على حالتك الرياضية</p>
                </div>
            </header>

            {{-- Stats --}}
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

                {{-- Attendance --}}
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

                {{-- Diet --}}
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

        </main>
    </div>
</body>
</html>
