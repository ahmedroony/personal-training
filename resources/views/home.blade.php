<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM CORE - مرحباً بك</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <div class="bg-grid"></div>
    <div class="glow"></div>

    <nav class="top-nav">
        <div class="brand">GYM CORE</div>
        <div class="nav-actions">
            @auth
                @if(auth()->user()->userType?->name == 'Admin')
                    <a href="{{ route('admin.index') }}" class="btn-nav">لوحة المدير</a>
                @elseif(auth()->user()->userType?->name == 'Captain')
                    <a href="/captain/dashboard" class="btn-nav">لوحة الكابتن</a>
                @else
                    <a href="{{ route('client.dashboard') }}" class="btn-nav btn-primary-nav">لوحتي</a>
                @endif
            @else
                <a href="{{ route('show.login') }}" class="btn-nav">تسجيل الدخول</a>
            @endauth
        </div>
    </nav>

    <main>
        <section class="hero">
            <div class="badge">🏆 نظام إدارة الصالات الرياضية #1</div>
            <h1>ابدأ رحلتك<br><span class="highlight">الرياضية الآن</span></h1>
            <p>تابع تمارينك، نظامك الغذائي، وحضورك في مكان واحد. انضم إلى آلاف المتدربين الذين يحققون أهدافهم مع GYM CORE.</p>
            <div class="hero-actions">
                @guest
                    <a href="{{ route('show.login') }}" class="btn btn-primary">ابدأ الآن →</a>
                @else
                    <a href="{{ route('client.dashboard') }}" class="btn btn-primary">لوحتي →</a>
                @endguest
            </div>
        </section>

        <section class="features">
            <div class="feature-card">
                <div class="feature-icon">🥗</div>
                <h3>النظام الغذائي</h3>
                <p>احصل على نظامك الغذائي المخصص مباشرةً من المدرب</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <h3>سجل الحضور</h3>
                <p>تابع مواعيد حضورك وانتظامك في الجيم</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🏋️</div>
                <h3>جداول التمارين</h3>
                <p>برامج تمارين مخصصة تناسب مستواك وأهدافك</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>تتبع التقدم</h3>
                <p>شاهد مسيرتك الرياضية وتطورك بمرور الوقت</p>
            </div>
        </section>
    </main>
</body>
</html>
