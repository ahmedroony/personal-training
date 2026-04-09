<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM CORE - مرحباً بك</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #0d6efd; 
            margin-bottom: 15px;
        }

        .card {
            border: 1px solid #eaeaea;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-4" href="#">GYM CORE</a>

            <div class="d-flex align-items-center">
                @auth
                    @if(auth()->user()->userType?->name == 'Admin')
                        <a href="{{ route('admin.index') }}" class="btn btn-outline-dark ms-2">لوحة المدير</a>
                    @elseif(auth()->user()->userType?->name == 'Captain')
                        <a href="/captain/dashboard" class="btn btn-outline-dark ms-2">لوحة الكابتن</a>
                    @else
                        <a href="{{ route('client.dashboard') }}" class="btn btn-primary ms-2">لوحتي</a>
                    @endif
                @else
                    <a href="{{ route('show.login') }}" class="btn btn-outline-primary px-4">تسجيل الدخول</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        <section class="py-5 text-center bg-white border-bottom">
            <div class="container py-5">
                <h1 class="display-5 fw-bold text-dark mb-3">نظام إدارة الصالات الرياضية</h1>
                <p class="lead text-muted mb-4 col-md-8 mx-auto">
                    تابع تمارينك، نظامك الغذائي، وحضورك في مكان واحد بسهولة ووضوح.
                </p>

                <div class="mt-4">
                    @guest
                        <a href="{{ route('show.login') }}" class="btn btn-primary btn-lg px-5">ابدأ الآن</a>
                    @else
                        <a href="{{ route('client.dashboard') }}" class="btn btn-primary btn-lg px-5">الذهاب إلى لوحتي</a>
                    @endguest
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="row g-4 text-center">

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100 p-4 bg-white shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-egg-fried feature-icon"></i>
                                <h5 class="card-title fw-bold">النظام الغذائي</h5>
                                <p class="card-text text-muted small">نظام غذائي مخصص من مدربك.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100 p-4 bg-white shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-calendar-check feature-icon"></i>
                                <h5 class="card-title fw-bold">سجل الحضور</h5>
                                <p class="card-text text-muted small">تابع مواعيد حضورك وانتظامك.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100 p-4 bg-white shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-activity feature-icon"></i>
                                <h5 class="card-title fw-bold">جداول التمارين</h5>
                                <p class="card-text text-muted small">برامج تمارين تناسب مستواك.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100 p-4 bg-white shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-graph-up feature-icon"></i>
                                <h5 class="card-title fw-bold">تتبع التقدم</h5>
                                <p class="card-text text-muted small">شاهد تطورك بمرور الوقت.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
