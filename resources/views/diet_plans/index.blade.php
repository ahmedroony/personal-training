<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الأنظمة الغذائية - GYM CORE</title>
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
                    <li class="active"><a href="{{ route('diet_plans.index') }}">الأنظمة الغذائية</a></li>
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
                    <h1>الأنظمة الغذائية</h1>
                    <p>إدارة وتعيين الأنظمة الغذائية بطريقة سهلة واحترافية</p>
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
            <!-- 1. تعيين المتدربين -->
            <section class="form-card">
                <h3>👥 اختيار المتدربين</h3>
                <form action="{{ route('diet_plans.store') }}" method="POST">
                    <div class="select-clients">
                        <label>الرجاء تحديد متدرب أو أكثر لتعيين النظام لهم:</label>
                        <select multiple class="custom-select" name="user_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
            </section>

            <!-- 2. النظام الغذائي الحر (النوتة) والقوالب -->
            <section class="form-card">
                @csrf
                @method('POST')
                <div class="section-header">
                    <h3>📝 النظام الغذائي الحر (النوتة)</h3>
                    <div class="template-selector">
                        <label>استيراد قالب جاهز:</label>
                        <select>
                            <option value="">-- اختر قالباً --</option>
                            <option value="1">تنشيف 2000 سعرة</option>
                            <option value="2">تضخيم 3500 سعرة</option>
                        </select>
                    </div>
                </div>
                <div class="free-text-area">
                    <textarea name="description" placeholder="اكتب النظام الغذائي الخاص بالعميل هنا بكل حرية، كما تفعل في جداول التمارين..."
                        required></textarea>
                </div>
                <button type="submit" class="save-plan-btn large">💾 حفظ وتعيين النظام للعملاء المحددين</button>
                </form>
            </section>


        </main>
    </div>
</body>

</html>
