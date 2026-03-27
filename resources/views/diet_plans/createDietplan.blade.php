<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>انشاء الأنظمة الغذائية - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/diet_plans/index.css')
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            <nav>
                <ul>
                    <li><a href="{{ route('admin.index') }}">الرئيسية</a></li>
                    <li><a href="{{ route('admin.manage') }}">إدارة العملاء</a></li>
                    <li><a href="{{ route('admin.captains.index') }}">إدارة الكباتن</a></li>
                    <li><a href="{{ route('workout.index') }}">جداول التمارين</a></li>
                    <li class="active"><a href="{{ route('create_diet_plans.index') }}">انشاء الأنظمة الغذائية</a></li>
                    <li><a href="{{ route('diet_plans.index') }}">الأنظمة الغذائية</a></li>
                    <li><a href="{{ route('foods.index') }}">كتالوج الأكل</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            @if ($errors->any())
                <div
                    style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: right;">
                    <strong>عفواً، يوجد أخطاء في البيانات:</strong>
                    <ul style="margin-top: 10px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <header class="header-section">
                <div>
                    <h1>انشاء الأنظمة الغذائية</h1>
                    <p>إضافة قوالب وأنظمة غذائية جديدة</p>
                </div>
                <div>
                    @if (session('success'))
                        <div
                            style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; background-color: #198754; color: white; padding: 15px 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.2); font-weight: bold; text-align: center;">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </header>

            <section class="form-card">
                <div class="section-header">
                    <h3>📝 إضافة نظام غذائي جديد</h3>
                </div>
                <form action="{{ route('create_diet_plans.store') }}" method="POST">
                    @csrf
                    
                    <div style="margin-bottom: 20px;">
                        <label for="name">الاسم / اسم النظام الغذائي</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="free-text-area" style="margin-bottom: 20px;">
                        <label for="base_description">التفاصيل والوصف الأساسي</label>
                        <textarea name="base_description" id="base_description" required>{{ old('base_description') }}</textarea>
                    </div>

                    <button type="submit" class="save-plan-btn large">💾 حفظ النظام الغذائي</button>
                </form>
            </section>
        </main>
    </div>
</body>

</html>
