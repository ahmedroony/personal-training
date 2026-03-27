<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كتالوج الأكل - GYM CORE</title>
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
                    <li><a href="{{ route('diet_plans.index') }}">الأنظمة الغذائية</a></li>
                    <li class="active"><a href="{{ route('foods.index') }}">كتالوج الأكل</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header-section">
                <button>اضافه وجبه</button>
                <div>
                    <h1>كتالوج الأكل</h1>
                    <p>بناء وجبات مخصصة وتصفح بدائل الأكل</p>
                </div>
            </header>

            <div class="catalog-calculator-wrapper form-card">
                <div class="catalog-header">
                    <h3>🎯 بناء وجبات مخصصة (كتالوج الأكل)</h3>
                    <p>استخدم هذه الإضافة إذا أردت حساب الجرامات والسعرات والماكروز بدقة، أو البحث عن بدائل</p>
                </div>

                <div class="catalog-layout">
                    <section class="food-catalog">
                        <div class="catalog-search">
                            <input type="text" placeholder="ابحث عن طعام (مثال: بيض، أرز، فراخ)...">
                        </div>
                        <div class="categories-tabs">
                            <button class="active">الكل</button>
                            <button>بروتين</button>
                            <button>نشويات</button>
                            <button>دهون صحية</button>
                            <button>خضار وفاكهة</button>
                        </div>
                        <div class="food-grid">
                            <div class="food-card">
                                <h4></h4>
                                <p class="nutrition">بروتين: 6g | كارب: 1g | دهون: 5g</p>
                                <p class="calories">السعرات: 70</p>
                                <button class="add-btn" title="إضافة للوجبة">+</button>
                            </div>
                            <div class="food-card">
                                <h4>صدر دجاج مشوي (100g)</h4>
                                <p class="nutrition">بروتين: 31g | كارب: 0g | دهون: 3.6g</p>
                                <p class="calories">السعرات: 165</p>
                                <button class="add-btn" title="إضافة للوجبة">+</button>
                            </div>
                        </div>
                    </section>

                    <section class="diet-summary">
                        <h3>📊 ملخص الماكروز للوجبة</h3>
                        <div class="selected-foods">
                            <ul class="food-list">
                                <li class="empty-list">لم يتم إضافة أطعمة بعد</li>
                            </ul>
                        </div>
                        <div class="summary-details">
                            <p>إجمالي البروتين: <span class="protein">0g</span></p>
                            <p>إجمالي الكارب: <span class="carbs">0g</span></p>
                            <p>إجمالي الدهون: <span class="fats">0g</span></p>
                            <hr>
                            <p class="total-cal-row">السعرات الكلية: <span class="total-calories">0</span></p>
                        </div>
                    </section>
                </div>
            </div>

        </main>
    </div>
</body>

</html>
