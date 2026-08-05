<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM CORE - مرحباً بك</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100 text-base-content min-h-screen flex flex-col font-sans">

    <!-- Header / Navbar -->
    <header class="navbar bg-base-200 border-b border-base-300 px-4 lg:px-12 sticky top-0 z-50">
        <div class="navbar-start">
            <a href="/" class="font-bold text-xl tracking-wide text-base-content">
                GYM CORE
            </a>
        </div>

        <div class="navbar-end gap-3">
            @auth
                @if(auth()->user()->userType?->name == 'Admin')
                    <a href="{{ route('admin.index') }}" class="btn btn-primary btn-sm">لوحة المدير</a>
                @elseif(auth()->user()->userType?->name == 'Captain')
                    <a href="/captain/dashboard" class="btn btn-primary btn-sm">لوحة الكابتن</a>
                @else
                    <a href="{{ route('client.dashboard') }}" class="btn btn-primary btn-sm">لوحتي الشخصية</a>
                @endif
            @else
                <a href="{{ route('show.login') }}" class="btn btn-primary btn-sm">تسجيل الدخول</a>
            @endauth
        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-1">
        <section class="hero min-h-[50vh] bg-base-200 border-b border-base-300">
            <div class="hero-content text-center py-16 px-4 max-w-3xl">
                <div>
                    <h1 class="text-3xl md:text-5xl font-bold text-base-content mb-4">
                        نظام إدارة الصالات الرياضية GYM CORE
                    </h1>
                    <p class="text-base md:text-lg text-base-content/70 mb-8 max-w-xl mx-auto">
                        متابعة التمارين الرياضية، الخطط الغذائية، وسجل الحضور اليومي في مكان واحد.
                    </p>

                    <div>
                        @guest
                            <a href="{{ route('show.login') }}" class="btn btn-primary px-8">
                                ابدأ الآن
                            </a>
                        @else
                            <a href="{{ route('client.dashboard') }}" class="btn btn-primary px-8">
                                الذهاب إلى لوحتي
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Grid -->
        <section class="py-12 px-4 md:px-12 max-w-6xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold mb-2">مميزات المنصة</h2>
                <p class="text-sm text-base-content/60">كل ما تحتاجه لإدارة وتتبع رحلتك الرياضية</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1 -->
                <div class="card bg-base-200 border border-base-300">
                    <div class="card-body p-6 text-center">
                        <h3 class="card-title font-bold text-base justify-center mb-2">النظام الغذائي</h3>
                        <p class="text-base-content/60 text-xs leading-relaxed">نظام غذائي مخصص تم إعداده خصيصاً من قِبل مدربك.</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="card bg-base-200 border border-base-300">
                    <div class="card-body p-6 text-center">
                        <h3 class="card-title font-bold text-base justify-center mb-2">سجل الحضور</h3>
                        <p class="text-base-content/60 text-xs leading-relaxed">متابعة مواعيد حضورك وانتظامك بسهولة.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="card bg-base-200 border border-base-300">
                    <div class="card-body p-6 text-center">
                        <h3 class="card-title font-bold text-base justify-center mb-2">جداول التمارين</h3>
                        <p class="text-base-content/60 text-xs leading-relaxed">برامج تمارين مصممة بدقة لتناسب مستواك الرياضي.</p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="card bg-base-200 border border-base-300">
                    <div class="card-body p-6 text-center">
                        <h3 class="card-title font-bold text-base justify-center mb-2">تتبع التقدم</h3>
                        <p class="text-base-content/60 text-xs leading-relaxed">متابعة التطور البدني والرياضي بمرور الوقت.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer footer-center p-4 bg-base-200 border-t border-base-300 text-xs text-base-content/60">
        <aside>
            <p>جميع الحقوق محفوظة &copy; {{ date('Y') }} - GYM CORE</p>
        </aside>
    </footer>

</body>
</html>
