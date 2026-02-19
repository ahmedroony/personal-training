<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة العملاء - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="resources/css/Captain/manage.css">
    @vite('resources/css/admin/manage.css')
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            <nav>
                <ul>
                    <li><a href="#"> الرئيسية</a></li>
                    <li class="active"><a href="#"> إدارة العملاء</a></li>
                    <li><a href="#"> جداول التمارين</a></li>
                    <li><a href="#"> الأنظمة الغذائية</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header-section">
                <div>
                    <h1>سجل المشتركين</h1>
                    <p>إدارة، بحث وتعديل بيانات المتدربين</p>
                </div>
                <div>
                    <a href="" class="btn-primary">+ كابتن جديد</a>
                    <a href="{{ route('admin.createclient') }}" class="btn-primary">+ مشترك جديد</a>
                </div>
            </header>

            <section class="form-card">
                <h3>🔍 أدوات البحث</h3>
                <div class="filters-grid">
                    <input type="text" placeholder="ابحث بالاسم أو رقم الهاتف..." style="flex: 2;">
                    <select style="flex: 1;">
                        <option value="">كل الحالات</option>
                        <option value="active">نشط</option>
                        <option value="inactive">منتهي</option>
                    </select>
                    <button class="btn-primary">بحث</button>
                </div>
            </section>

            <section class="form-card">
                <h3>📋 قائمة المتدربين</h3>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>المتدرب</th>
                                <th>رقم الهاتف</th>
                                <th>الباقة</th>
                                <th>تاريخ الانتهاء</th>
                                <th>عدد الايام</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>أحمد محمود</td>
                                <td>01012345678</td>
                                <td>باقة التخسيس 3 شهور</td>
                                <td>2026-05-15</td>
                                <td>90</td>
                                <td>
                                    <span style="color: green; font-weight: bold;">نشط</span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="#" title="تعديل" style="color: #ffc107; text-decoration: none;">✏️</a>
                                        <button type="button" title="تفعيل/تعطيل" style="background: none; border: none; cursor: pointer;">🔄</button>
                                        <button type="button" title="حذف" style="color: #dc3545; background: none; border: none; cursor: pointer;">🗑️</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>محمد علي</td>
                                <td>01198765432</td>
                                <td>خطة تمارين شهرية</td>
                                <td>2026-01-10</td>
                                <td>30</td>
                                <td>
                                    <span style="color: red; font-weight: bold;">منتهي</span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="#" title="تعديل" style="color: #ffc107; text-decoration: none;">✏️</a>
                                        <button type="button" title="تفعيل/تعطيل" style="background: none; border: none; cursor: pointer;">🔄</button>
                                        <button type="button" title="حذف" style="color: #dc3545; background: none; border: none; cursor: pointer;">🗑️</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>ياسر إبراهيم</td>
                                <td>01234567890</td>
                                <td>غير محدد</td>
                                <td>2026-06-20</td>
                                <td>غير محدد</td>
                                <td>
                                    <span style="color: green; font-weight: bold;">نشط</span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="#" title="تعديل" style="color: #ffc107; text-decoration: none;">✏️</a>
                                        <button type="button" title="تفعيل/تعطيل" style="background: none; border: none; cursor: pointer;">🔄</button>
                                        <button type="button" title="حذف" style="color: #dc3545; background: none; border: none; cursor: pointer;">🗑️</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
