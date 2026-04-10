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

    <main class="main-content">

        <header class="page-header">
            <div>
                <h1>أهلاً، كابتن {{ $captain->name }} 💪</h1>
                <p>لوحة تحكمك الشخصية</p>
            </div>
        </header>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

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

        <!-- ── إدارة المشتركين ── -->
        <section class="section-card mb-4">
            <h2>👥 إدارة المشتركين في فريقك</h2>
            
            <!-- نموذج إضافة مشترك -->
            <div class="add-client-form mb-4" style="background: rgba(255,255,255,0.02); padding: 20px; border-radius: 14px; border: 1px dashed var(--border);">
                <p style="margin-bottom: 15px; font-weight: 700; font-size: 15px;">➕ إضافة مشترك جديد للفريق</p>
                <form action="{{ route('captain.addClient') }}" method="POST" class="form-grid">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">اسم المشترك</label>
                        <input type="text" name="name" class="form-control" required placeholder="الاسم كامل">
                    </div>
                    <div class="form-group">
                        <label class="form-label">البريد الإلكتروني (اختياري)</label>
                        <input type="email" name="email" class="form-control" placeholder="example@mail.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="text" name="phone" class="form-control" required placeholder="01xxxxxxxxx">
                    </div>

                    <div class="form-group">
                        <label class="form-label">اختر الباقة</label>
                        <select name="plan_id" id="plan-select" class="form-select" required>
                            <option value="" disabled selected>اختر باقة التدريب...</option>
                            @foreach($allPlans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="submit-btn" style="height: 48px;">✅ إضافة للفريق</button>
                    
                    <div id="plan-details-box" class="form-group" style="display: none; grid-column: span 2; background: rgba(0,0,0,0.2); padding: 15px; border-radius: 8px; border: 1px solid var(--border);">
                        <h4 style="color: var(--accent); margin-bottom: 10px; font-size: 14px;">📋 تفاصيل الباقة المحددة</h4>
                        <div style="display: flex; gap: 20px; font-size: 13px;">
                            <div><strong>المدة: </strong> <span id="plan-duration"></span> يوم</div>
                            <div><strong>السعر: </strong> <span id="plan-price"></span> ج.م</div>
                            <div><strong>التفاصيل: </strong> <span id="plan-description"></span></div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="clients-list">
                <p style="margin-bottom: 12px; font-weight: 700;">📋 مشتركينا الحاليين</p>
                @if($myClients->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>اسم المشترك</th>
                                <th>الباقة</th>
                                <th>تاريخ الانتهاء</th>
                                <th>الأيام المتبقية</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($myClients as $myClient)
                                <tr>
                                    <td><strong>{{ $myClient->name }}</strong></td>
                                    <td>{{ $myClient->subscription->plan->name ?? 'بدون باقة' }}</td>
                                    <td>{{ $myClient->subscription && $myClient->subscription->end_date ? $myClient->subscription->end_date->format('Y-m-d') : '-' }}</td>
                                    <td>
                                        {{ $myClient->subscription->remaining_days ?? 0 }} يوم
                                    </td>
                                    <td>
                                        @if($myClient->subscription && $myClient->subscription->is_active)
                                            <span class="status-badge status-active">نشط</span>
                                        @else
                                            <span class="status-badge status-expired">منتهي</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <span>👥</span>
                        <p>لا يوجد مشتركين مرتبطين بك حالياً. ابدأ بإضافة أول مشترك!</p>
                    </div>
                @endif
            </div>
        </section>

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
