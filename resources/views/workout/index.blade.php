<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جداول التمارين - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/workout/index.css')
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
                    <li class="active"><a href="{{ route('workout.index') }}">جداول التمارين</a></li>
                    <li><a href="{{ route('diet_plans.index') }}">الأنظمة الغذائية</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header-section">
                <div>
                    <h1>جداول التمارين</h1>
                    <p>اختر متدرب واكتب التمارين أو الملاحظات الخاصة به</p>
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
            {{-- اختيار المتدرب --}}
            <section class="form-card">
                <h3>🏋️ اختر المتدرب</h3>
                <form action="{{ route('workout.store') }}" method="POST" class="client-form">
                    @csrf
                    <div style="margin-bottom: 20px;">
                        <select name="user_id" class="search-input"
                            style="width: 100%; height: 50px; background: #1a1a1a; color: white; border: 1px solid #333; padding: 10px; border-radius: 8px;"
                            required>
                            <option value="">-- اختر المتدرب من هنا --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <textarea name="description" class="workout-textarea" id="workoutText" placeholder="اكتب تفاصيل التمرين هنا..."
                        style="width: 100%; min-height: 200px; padding: 20px;"></textarea>

                    <div class="actions-bar">
                        <button type="submit" class="btn-save" style="width: 100%;">💾 حفظ الجدول</button>
                    </div>
                </form>
            </section>
        </main>
    </div>

</body>

</html>
