<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة العملاء - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
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
                    <li><a href="{{ route('workout.index') }}"> جداول التمارين</a></li>
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
                <h3>📋 قائمة المتدربين</h3>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>المتدرب</th>
                                <th>رقم الهاتف</th>
                                <th>الباقة</th>
                                <th>الأيام المتبقية</th>
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
                                <td>{{ $user->subscription?->remaining_days ?? 0 }} يوم</td>
                                <td>
                                    @if ($user->subscription?->is_active)
                                        <span class="badge active">نشط</span>
                                    @else
                                        <span class="badge inactive">منتهي</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->subscription?->description)
                                        <details style="cursor: pointer;">
                                            <summary style="color: #007bff; font-size: 13px;">🔎 عرض</summary>
                                            <div style="background: #1a1a1a; padding: 10px; border-radius: 5px; margin-top: 5px; font-size: 13px; color: #ccc; border: 1px solid #333; position: absolute; z-index: 100; max-width: 250px;">
                                                {{ $user->subscription->description }}
                                            </div>
                                        </details>
                                    @else
                                        <span style="color: #888; font-size: 12px;">--</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->subscription?->is_active)
                                        <span class="badge active">نشط</span>
                                    @else
                                        <span class="badge inactive">منتهي</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-btns" style="display: flex; gap: 10px; align-items: center;">
                                        <a href="{{ route('admin.editClient', $user->id) }}" title="تعديل" style="color: #ffc107; text-decoration: none; font-size: 18px;">✏️</a>
                                        <form action="{{ route('admin.deleteClient', $user->id) }}" method="POST" style="margin: 0; display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="حذف" style="color: #dc3545; background: none; border: none; cursor: pointer; font-size: 18px;">🗑️</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
