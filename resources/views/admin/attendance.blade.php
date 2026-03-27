<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سجل الحضور - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/admin/manage.css') 
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            <nav>
                <ul>
                    <li><a href="{{ route('admin.index') }}"> الرئيسية</a></li>
                    <li><a href="{{ route('admin.manage') }}"> إدارة العملاء</a></li>
                    <li><a href="{{ route('admin.captains.index') }}"> إدارة الكباتن</a></li>
                    <li><a href="{{ route('workout.index') }}"> جداول التمارين</a></li>
                    <li><a href="{{ route('diet_plans.index') }}"> الأنظمة الغذائية</a></li>
                    <li class="active"><a href="{{ route('admin.attendance') }}">📋 سجل الحضور</a></li>
                </ul>
            </nav>
        </aside>
        
        <main class="main-content">
            @if(session('success'))
                <div style="background-color: #198754; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                    {{ session('success') }}
                </div>
            @endif
            <header class="header-section">
                <div>
                    <h1>سجل حضور المتدربين اليوم</h1>
                    <p>بحث باسم المتدرب لتسجيل حضوره</p>
                </div>
            </header>
            
            <section class="form-card">
                <h3>📋 قائمة المتدربين لتسجيل الحضور</h3>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>حالة الاشتراك</th>
                                <th>آخر حضور</th>
                                <th>إجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="client-row">
                                <td>{{ $user->name }}</td>
                                <td>
                                    @if($user->subscription && $user->subscription->is_active)
                                        <span class="badge active">نشط</span>
                                    @else
                                        <span class="badge inactive">منتهي</span>
                                    @endif
                                </td>
                                <td>
                                    <span style="color: #fff; font-size: 13px;">
                                        {{ $user->subscription->last_attendance_info ?? 'لا يوجد اشتراك' }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->subscription && $user->subscription->is_active)
                                    <form action="{{ route('admin.attendance.store', $user->subscription->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-primary" style="background-color: #28a745; padding: 5px 10px; border: none; border-radius: 4px; color: #fff; cursor: pointer;">
                                            ✅ تسجيل حضور
                                        </button>
                                    </form>
                                @else
                                        <button disabled style="background-color: #555; padding: 5px 10px; border: none; border-radius: 4px; color: #999; cursor: not-allowed;">
                                            جدد اشتراكك
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
