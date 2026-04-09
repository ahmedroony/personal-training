<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الكابتن | GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/captain.css') }}">
</head>
<body>
<div class="app-wrapper">

    {{-- Sidebar --}}
    <aside class="sidebar">
        <div class="logo">GYM CORE</div>
        <nav class="nav-links">
            <a href="{{ route('captain.dashboard') }}" class="active">🏠 الرئيسية</a>
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

        {{-- Header --}}
        <header class="page-header">
            <div>
                <h1>أهلاً، كابتن {{ $captain->name }} 💪</h1>
                <p>لوحة تحكمك الشخصية</p>
            </div>
        </header>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Check-in Card --}}
        <div class="checkin-card">
            @if($attendedToday)
                <div class="checkin-done">
                    <span class="checkin-icon">✅</span>
                    <div>
                        <p class="checkin-title">سجّلت حضورك النهارده!</p>
                        <p class="checkin-sub">أداء ممتاز، استمر! 🔥</p>
                    </div>
                </div>
            @else
                <div class="checkin-pending">
                    <span class="checkin-icon">⏰</span>
                    <div>
                        <p class="checkin-title">لم تسجّل حضورك بعد</p>
                        <p class="checkin-sub">اضغط الزرار عشان تسجّل وجودك في الجيم</p>
                    </div>
                </div>
                <form action="{{ route('captain.checkin') }}" method="POST">
                    @csrf
                    <button type="submit" class="checkin-btn">📍 سجّل حضوري الآن</button>
                </form>
            @endif
        </div>

        {{-- Stats --}}
        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📅</div>
                <div>
                    <p class="stat-label">أيام الحضور هذا الشهر</p>
                    <p class="stat-value">{{ $monthCount }} يوم</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div>
                    <p class="stat-label">إجمالي أيام الحضور</p>
                    <p class="stat-value">{{ $attendances->count() }} يوم</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🗓️</div>
                <div>
                    <p class="stat-label">حالة اليوم</p>
                    <p class="stat-value" style="color: {{ $attendedToday ? '#28a745' : '#ffc107' }}">
                        {{ $attendedToday ? 'حاضر ✅' : 'لم يسجّل بعد' }}
                    </p>
                </div>
            </div>
        </section>

        {{-- Attendance History --}}
        <section class="section-card">
            <h2>📋 سجل الحضور الكامل</h2>
            @if($attendances->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>التاريخ</th>
                            <th>اليوم</th>
                            <th>وقت الحضور</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $i => $att)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $att->date->format('Y-m-d') }}</td>
                                <td>{{ $att->date->locale('ar')->isoFormat('dddd') }}</td>
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

    </main>
</div>
</body>
</html>
