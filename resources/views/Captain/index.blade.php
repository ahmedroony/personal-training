<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #000;
            --card-bg: #111;
            --primary: #007bff;
            --text: #fff;
            --muted: #888;
            --border: #222;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Cairo', sans-serif; }
        body { background: var(--bg); color: var(--text); overflow-x: hidden; }

        .app-wrapper { display: flex; min-height: 100vh; }

        /* --- القائمة الجانبية (Responsive Sidebar) --- */
        .sidebar {
            width: 250px;
            background: #080808;
            border-left: 1px solid var(--border);
            padding: 20px;
            position: fixed;
            height: 100vh;
            transition: 0.3s;
            z-index: 1000;
        }

        .logo { font-size: 24px; font-weight: bold; color: var(--primary); margin-bottom: 40px; text-align: center; }

        .nav-links a {
            display: block;
            padding: 12px 15px;
            color: var(--muted);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .nav-links a.active, .nav-links a:hover { background: #1a1a1a; color: var(--primary); }

        /* --- المحتوى الرئيسي --- */
        .main-content { margin-right: 250px; flex: 1; padding: 30px; transition: 0.3s; }

        /* --- الكروت التفاعلية (Stats Cards) --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 15px;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: 0.4s;
            position: relative;
        }

        /* أنميشن عند الوقوف على الكارت */
        .stat-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(0, 123, 255, 0.1);
        }

        /* تمييز الكارت النشط حالياً */
        .stat-card.active-filter { border: 2px solid var(--primary); background: #1a1a1a; }

        .stat-card h3 { font-size: 14px; color: var(--muted); margin-bottom: 10px; }
        .stat-card .number { font-size: 30px; font-weight: bold; color: var(--primary); }

        /* --- الجدول --- */
        .data-card { background: var(--card-bg); border-radius: 15px; padding: 20px; border: 1px solid var(--border); }
        .data-card h2 { margin-bottom: 20px; font-size: 18px; }

        .responsive-table { width: 100%; border-collapse: collapse; }
        .responsive-table th { text-align: right; padding: 15px; color: var(--muted); border-bottom: 1px solid var(--border); }
        .responsive-table td { padding: 15px; border-bottom: 1px solid var(--border); }

        .badge { padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold; }
        .badge.active { background: rgba(40, 167, 69, 0.1); color: #28a745; }
        .badge.inactive { background: rgba(220, 53, 69, 0.1); color: #dc3545; }

        /* --- الموبايل (Responsive) --- */
        .menu-btn { display: none; background: var(--primary); color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(250px); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-right: 0; padding: 15px; }
            .menu-btn { display: block; margin-bottom: 20px; }
        }

        /* أنميشن اختفاء وظهر الصفوف */
        .client-row { transition: 0.3s; }
    </style>
</head>
<body>

    <div class="app-wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="logo">GYM CORE</div>
            <nav class="nav-links">
                <a href="#" class="active">الرئيسية</a>
                <a href="{{ route('page.edit') }}">إدارة العملاء</a>
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
                            <td>{{ $client->package_name ?? 'غير محدد' }}</td>
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
