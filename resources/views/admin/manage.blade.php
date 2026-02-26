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
                    <li><a href="{{ route('admin.index') }}"> الرئيسية</a></li>
                    <li class="active"><a href="{{ route('admin.manage') }}"> إدارة العملاء</a></li>
                    <li><a href="{{ route('admin.captains.index') }}"> إدارة الكباتن</a></li>
                    <li><a href="#"> جداول التمارين</a></li>
                    <li><a href="#"> الأنظمة الغذائية</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            @if(session('success'))
                <div style="background-color: #198754; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif
            <header class="header-section">
                <div>
                    <h1>سجل المشتركين</h1>
                    <p>إدارة، بحث وتعديل بيانات المتدربين</p>
                </div>
                <div>
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
                                <th>عدد الأيام </th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($users as $user)
                            <tr
                            class="client-row"data-status="{{ $user->subscription?->is_active ? 'active' : 'inactive' }}">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->subscription?->name_plan ?? 'لا يوجد اشتراك' }}</td>
                                <td>{{ $user->subscription?->duration ?? 0 }} يوم</td>
                                <td>
                                    @if ($user->subscription?->is_active)
                                        <span class="badge active">نشط</span>
                                    @else
                                        <span class="badge inactive">منتهي</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <form action="{{ route('admin.deleteClient', $user->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="حذف" style="color: #dc3545; background: #2d2d2d; border: thin; cursor: pointer;">🗑️</button>
                                        </form>
                                        <a href="{{ route('admin.editClient', $user->id) }}" title="تعديل" style="color: #ffc107; text-decoration: none;">✏️</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
