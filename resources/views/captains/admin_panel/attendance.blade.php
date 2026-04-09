<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حضور الكباتن | GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Admin/index.css') }}"> {{-- نستخدم نفس ستايل لوحة التحكم لتوحيد الشكل --}}
    <style>
        .captain-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .captain-card { background: #111; border: 1px solid #222; padding: 20px; border-radius: 12px; display: flex; align-items: center; gap: 15px; }
        .avatar { width: 50px; height: 50px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px; }
        .cap-info h4 { font-size: 16px; margin-bottom: 4px; }
        .cap-info p { font-size: 12px; color: #666; }
    </style>
</head>

<body>
    <div class="app-wrapper">
        @include('layouts.sidebar')

        <main class="main-content">
            <header style="margin-bottom: 30px;">
                <h1>🏅 تقرير حضور الكباتن</h1>
                <p style="color: var(--muted);">مراقبة سجل حضور وانصراف مدربي الصالة الرياضية</p>
            </header>

            {{-- ملخص الكباتن --}}
            <section class="captain-stats">
                @foreach($captains as $captain)
                    <div class="captain-card">
                        <div class="avatar">{{ mb_substr($captain->name, 0, 1) }}</div>
                        <div class="cap-info">
                            <h4>{{ $captain->name }}</h4>
                            <p>📞 {{ $captain->phones->first()->number ?? 'بدون هاتف' }}</p>
                        </div>
                    </div>
                @endforeach
            </section>

            <div class="data-card">
                <h2>📋 سجل الحضور الكامل</h2>
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>الكابتن</th>
                            <th>التاريخ</th>
                            <th>اليوم</th>
                            <th>الوقت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $att)
                            <tr class="client-row">
                                <td><strong style="color: var(--primary);">{{ $att->captain->name }}</strong></td>
                                <td>{{ $att->date->format('Y-m-d') }}</td>
                                <td>{{ $att->date->locale('ar')->isoFormat('dddd') }}</td>
                                <td>{{ $att->time }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 30px; color: #666;">لم يتم تسجيل أي حضور للكباتن بعد.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div style="margin-top: 20px;">
                    {{ $attendances->links() }}
                </div>
            </div>
        </main>
    </div>
</body>

</html>
