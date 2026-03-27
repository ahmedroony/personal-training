<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعيين الأنظمة الغذائية - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/admin/manage.css') 
    <style>
        .description-box {
            background: #1a1a1a;
            border: 1px solid #333;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            display: none;
            color: #ccc;
            font-size: 14px;
            line-height: 1.6;
        }
        .form-select, .form-textarea {
            width: 100%;
            padding: 12px;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 6px;
            color: white;
            margin-top: 5px;
            font-family: 'Cairo', sans-serif;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #eee;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            <nav>
                <ul>
                    <li><a href="{{ route('admin.index') }}"> الرئيسية</a></li>
                    <li><a href="{{ route('admin.manage') }}"> إدارة العملاء</a></li>
                    <li><a href="{{ route('admin.captains.index') }}"> إدارة الكباتن</a></li>
                    <li><a href="{{ route('workout.index') }}"> جداول التمارين</a></li>
                    <li class="active"><a href="{{ route('diet_plans.index') }}"> الأنظمة الغذائية</a></li>
                    <li><a href="{{ route('admin.attendance') }}"> سجل الحضور</a></li>
                </ul>
            </nav>
        </aside>
        
        <main class="main-content">
            @if(session('success'))
                <div style="background-color: #198754; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                    {{ session('success') }}
                </div>
            @endif

            <header class="header-section">
                <div>
                    <h1>🥗 تعيين الأنظمة الغذائية</h1>
                    <p>اختر المتدرب والنظام الغذائي المناسب له مع إضافة ملاحظات خاصة</p>
                </div>
            </header>
            
            <section class="form-card" style="max-width: 800px; margin: 0 auto;">
                <form action="{{ route('diet_plans.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>1. اختر المتدرب (المشتركين الحاليين)</label>
                        <select name="subscription_id" class="form-select" required>
                            <option value="">-- اختر المتدرب --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->subscription->id }}">
                                    {{ $user->name }} (ينتهي في: {{ $user->subscription->end_date->format('Y-m-d') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>2. اختر نظاماً غذائياً (Template)</label>
                        <select name="diet_plan_id" class="form-select" onchange="showDescription(this)" required>
                            <option value="">-- اختر النظام --</option>
                            @foreach($dietPlans as $plan)
                                <option value="{{ $plan->id }}" data-description="{{ $plan->base_description }}">
                                    {{ $plan->name }}
                                </option>
                            @endforeach
                        </select>
                        <div id="planDescription" class="description-box">
                            <strong>وصف النظام المختارة:</strong>
                            <p id="descriptionText"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>3. ملاحظات مخصصة للمتدرب (إضافات، استثناءات، صيام، إلخ)</label>
                        <textarea name="custom_notes" rows="5" class="form-textarea" placeholder="اكتب أي ملاحظات إضافية هنا..."></textarea>
                    </div>

                    <button type="submit" class="btn-primary" style="width: 100%; padding: 15px; font-size: 16px; margin-top: 10px;">
                        💾 حفظ وتعيين النظام
                    </button>
                </form>
            </section>
        </main>
    </div>

    <script>
        // وظيفة بسيطة تظهر وصف النظام عند اختياره من القائمة
        function showDescription(selectElement) {
            const descriptionText = selectElement.options[selectElement.selectedIndex].getAttribute('data-description');
            const descriptionBox = document.getElementById('planDescription');
            
            if (descriptionText) {
                document.getElementById('descriptionText').textContent = descriptionText;
                descriptionBox.style.display = 'block';
            } else {
                descriptionBox.style.display = 'none';
            }
        }
    </script>
</body>
</html>
