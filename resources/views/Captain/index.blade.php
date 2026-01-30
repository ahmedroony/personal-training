<!DOCTYPE html>
<html lang="en">

<head>
    <html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>لوحة تحكم الكابتن - Gym System</title>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
        @vite('resources/css/Captain/Captain.css')
    </head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            <nav>
                <ul>
                    <li class="active">الرئيسية</li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header>
                <h1>لوحة تحكم الكابتن</h1>
                <p>مرحباً بك مجدداً. يمكنك هنا متابعة المتدربين وتصميم جداولهم.</p>
            </header>

            <section class="stats-cards">
                <div class="card">
                    <h3>المشتركين</h3>
                    <p class="number">24</p>
                </div>
                <div class="card">
                    <h3>خطط التدريب</h3>
                    <p class="number">15</p>
                </div>
                <div class="card">
                    <h3>باقات أوشكت على الانتهاء</h3>
                    <p class="number">3</p>
                </div>
            </section>
            <section class="data-section">
                <div class="section-header">
                    <h2>المشتركين الحاليين</h2>
                    <a class="btn-primary" href="<?php echo route('captain.create') ?>">+ إضافة عميل</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الباقة</th>
                            <th>الحالة</th>
                            <th>إجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>أحمد محمد</td>
                            <td>تضخيم 3 أشهر</td>
                            <td><span class="status active">نشط</span></td>
                            <td><button class="btn-action">تعديل</button></td>
                        </tr>
                        <tr>
                            <td>سيد حسن</td>
                            <td>تخسيس شهر</td>
                            <td><span class="status inactive">منتهي</span></td>
                            <td><button class="btn-action">تجديد</button></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
