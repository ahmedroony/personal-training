<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء خطة غذائية - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/workout/index.css') }}">
</head>

<body>
    <div class="dashboard-container">
        @include('layouts.sidebar')

        <main class="main-content">
            <header class="header-section">
                <div>
                    <h1>🥗 إنشاء خطة غذائية</h1>
                    <p>أضف خطة غذائية جديدة للمتدربين</p>
                </div>
            </header>

            @if (session('success'))
                <div
                    style="background-color: #198754; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    style="background-color: #dc3545; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-right: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="form-card">
                <h3>📋 بيانات الخطة الغذائية</h3>
                <form action="{{ route('create_diet_plans.store') }}" method="POST" class="client-form">
                    @csrf

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; color: #aaa; margin-bottom: 8px; font-size: 14px;">اسم الخطة
                            الغذائية</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="مثال: خطة التضخم - 3000 سعرة" class="search-input"
                            style="width: 100%; height: 50px; background: #1a1a1a; color: white; border: 1px solid #333; padding: 10px 15px; border-radius: 8px; font-family: inherit; font-size: 15px;"
                            required>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; color: #aaa; margin-bottom: 8px; font-size: 14px;">وصف الخطة
                            الغذائية</label>
                        <textarea name="base_description" placeholder="اكتب تفاصيل الخطة الغذائية هنا... (الوجبات، السعرات، التوقيت)"
                            class="workout-textarea" style="width: 100%; min-height: 200px; padding: 20px;" required>{{ old('base_description') }}</textarea>
                    </div>

                    <div class="actions-bar">
                        <button type="submit" class="btn-save" style="width: 100%;">💾 حفظ الخطة الغذائية</button>
                    </div>
                </form>
            </section>

            {{-- قائمة الخطط الغذائية --}}
            <section class="form-card" style="margin-top: 30px;">
                <h3>📂 الخطط الغذائية الحالية</h3>

                @foreach ($users as $plan)
                    <div style="background: #1a1a1a; border: 1px solid #333; border-radius: 8px; padding: 15px; margin-bottom: 10px;">
                        <p style="color: white; font-weight: bold; margin: 0 0 5px;">🥗 {{ $plan->name }}</p>
                        <p style="color: #aaa; margin: 0; font-size: 13px;">{{ $plan->base_description }}</p>
                    </div>
                @endforeach

            </section>

        </main>
    </div>
</body>

</html>
