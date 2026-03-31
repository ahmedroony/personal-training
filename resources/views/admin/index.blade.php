<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Admin/index.css') }}">
</head>

<body>
    <div class="app-wrapper">
        @include('layouts.sidebar')

        <main class="main-content">
            <button class="menu-btn" onclick="toggleSidebar()">☰ القائمة</button>

            <header class="page-header">
                <div>
                    <h1>لوحة التحكم</h1>
                    <p style="color: var(--muted);">اضغط على الكروت للفلترة السريعة</p>
                </div>
                <div>
                    <span style="color: #555; font-size: 14px;">👋 {{ auth()->user()->name }}</span>
                </div>
            </header>

            <section class="stats-grid">
                <div class="stat-card active-filter" onclick="applyFilter('all', this)">
                    <h3>إجمالي المتدربين</h3>
                    <div class="number">{{ $usersCount }}</div>
                </div>
                <div class="stat-card" onclick="applyFilter('active', this)">
                    <h3>المشتركون النشطون</h3>
                    <div class="number">{{ $activeSubscribersCount }}</div>
                </div>
                <div class="stat-card" onclick="applyFilter('inactive', this)">
                    <h3>الاشتراكات المنتهية</h3>
                    <div class="number">{{ $inactiveSubscribersCount }}</div>
                </div>
            </section>

            <div class="data-card">
                <h2 id="table-title">عرض كل المشتركين</h2>
                <div class="table-responsive">
                    <table class="responsive-table">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الحالة</th>
                                <th>الباقة</th>
                                <th>الأيام المتبقية</th>
                                <th>التمرين</th>
                            </tr>
                        </thead>
                        <tbody id="clients-body">
                            @foreach ($users as $user)
                                <tr class="client-row" data-status="{{ ($user->subscription && $user->subscription->is_active) ? 'active' : 'inactive' }}">
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @if ($user->subscription && $user->subscription->is_active)
                                            <span class="badge active">نشط</span>
                                        @else
                                            <span class="badge inactive">منتهي</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->subscription->plan->name ?? 'بدون باقة' }}</td>
                                    <td>{{ $user->subscription->remaining_days ?? 0 }} يوم</td>
                                    <td>
                                        @if ($user->subscription?->plan?->description)
                                            <details style="cursor: pointer;">
                                                <summary style="color: var(--primary); font-size: 13px;">🔎 عرض</summary>
                                                <div
                                                    style="background: #1a1a1a; padding: 10px; border-radius: 5px; margin-top: 5px; font-size: 13px; color: #ccc; border: 1px solid #333; position: absolute; z-index: 100; max-width: 250px;">
                                                    {{ $user->subscription->plan->description }}
                                                </div>
                                            </details>
                                        @else
                                            <span style="color: var(--muted); font-size: 12px;">--</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script>
        function applyFilter(status, selectedCard) {
            const rows = document.querySelectorAll('.client-row');
            const cards = document.querySelectorAll('.stat-card');
            const title = document.getElementById('table-title');

            // 1. تحديث شكل الكارت المختار (UI)
            cards.forEach(card => card.classList.remove('active-filter'));
            selectedCard.classList.add('active-filter');

            // 2. تحديث عنوان الجدول
            if (status === 'all') title.innerText = "عرض كل المشتركين";
            if (status === 'active') title.innerText = "عرض المتدربين النشطين";
            if (status === 'inactive') title.innerText = "عرض الاشتراكات المنتهية";

            // 3. فلترة الصفوف مع أنميشن بسيط
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');

                if (status === 'all' || rowStatus === status) {
                    row.style.display = ""; // إظهار
                    setTimeout(() => row.style.opacity = "1", 10);
                } else {
                    row.style.opacity = "0"; // إخفاء تدريجي
                    setTimeout(() => row.style.display = "none", 300);
                }
            });
        }

        // كود فتح القائمة في الموبايل
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>
</body>

</html>
