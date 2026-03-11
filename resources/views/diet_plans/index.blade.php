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

            <!-- 3. المكملات والمياه -->
            <section class="form-card">
                <h3>💊 المكملات الغذائية والترطيب</h3>
                <div class="supplements-grid">
                    <div class="input-group">
                        <label>جدول المكملات (اختياري):</label>
                        <textarea rows="3" placeholder="مثال: سكوب واي بروتين بعد التمرين، 5 جرام كرياتين صباحاً..."></textarea>
                    </div>
                    <div class="input-group">
                        <label>هدف المياه اليومي (باللتر):</label>
                        <input type="number" step="0.5" placeholder="مثال: 4">
                    </div>
                </div>
            </section>

            <!-- 4. كتالوج الأكل (الإضافة الاحترافية) -->
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
                                <h4>بيضة مسلوقة (واحدة)</h4>
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
                            <div class="food-card">
                                <h4>أرز أبيض مطبوخ (100g)</h4>
                                <p class="nutrition">بروتين: 2.7g | كارب: 28g | دهون: 0.3g</p>
                                <p class="calories">السعرات: 130</p>
                                <button class="add-btn" title="إضافة للوجبة">+</button>
                            </div>
                            <div class="food-card">
                                <h4>لوز (30g)</h4>
                                <p class="nutrition">بروتين: 6g | كارب: 6g | دهون: 14g</p>
                                <p class="calories">السعرات: 164</p>
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

            <div class="bottom-actions">
                <button type="submit" class="save-plan-btn large">💾 حفظ وتعيين النظام للعملاء المحددين</button>
            </div>
            </form>
        </main>
    </div>
</body>

</html>
