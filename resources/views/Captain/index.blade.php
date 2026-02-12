<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/Captain/index.css');
</head>
<body>

    <div class="app-wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="logo">GYM CORE</div>
            <nav class="nav-links">
                <a href="#" class="active">الرئيسية</a>
                <a href="{{ route('captain.manage') }}">إدارة العملاء</a>
                <a href="#">جداول التمارين</a>
            </nav>
        </aside>

        <main class="main-content">
            <button class="menu-btn" onclick="toggleSidebar()">☰ القائمة</button>

            <header style="margin-bottom: 30px;">
                <h1>لوحة التحكم</h1>
                <p style="color: var(--muted);">اضغط على الكروت للفلترة السريعة</p>
            </header>

            <section class="stats-grid">
                <div class="stat-card active-filter" onclick="applyFilter('all', this)">
                    <h3>إجمالي المتدربين</h3>
                    <div class="number">{{ $clients->count() }}</div>
                </div>
                <div class="stat-card" onclick="applyFilter('active', this)">
                    <h3>المشتركون النشطون</h3>
                    <div class="number">{{ $clients->where('status', 'active')->count() }}</div>
                </div>
                <div class="stat-card" onclick="applyFilter('inactive', this)">
                    <h3>الاشتراكات المنتهية</h3>
                    <div class="number">{{ $clients->where('status', 'inactive')->count() }}</div>
                </div>
            </section>

            <div class="data-card">
                <h2 id="table-title">عرض كل المشتركين</h2>
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الحالة</th>
                            <th>الباقة</th>
                            <th>عدد الايام</th>
                            <th>عدد الأيام المتبقية</th>
                        </tr>
                    </thead>
                    <tbody id="clients-body">
                        @foreach($clients as $client)
                        <tr class="client-row" data-status="{{ $client->status }}">
                            <td>{{ $client->name }}</td>
                            <td>
                                <span class="badge {{ $client->status }}">
                                    {{ $client->status == 'active' ? 'نشط' : 'منتهي' }}
                                </span>
                            </td>
                            <td>
                                {{ $client->package_name ?? 'غير محدد' }}
                            </td>
                            <td>
                                {{ $client->duration_days?? 'غير محدد' }}
                            </td>
                            <td>
                                {{ $client->days_left }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
            if(status === 'all') title.innerText = "عرض كل المشتركين";
            if(status === 'active') title.innerText = "عرض المتدربين النشطين";
            if(status === 'inactive') title.innerText = "عرض الاشتراكات المنتهية";

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
