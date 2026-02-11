<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة العملاء - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/Captain/manage.css');
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">GYM CORE</div>
            <nav>
                <ul>
                    <li><a href="{{ route('captain.index') }}"> الرئيسية</a></li>
                    <li class="active"><a href="{{ route('captain.manage') }}"> إدارة العملاء</a></li>
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
                <a href="{{ route('captain.create') }}" class="btn-primary">+ مشترك جديد</a>
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
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->phone_number }}</td>
                                    <td> {{ $client->package->name ?? 'غير محدد' }}</td>
                                    <td>{{ $client->subscription_ends_at }}</td>
                                    <td>
                                        {{ $client->days_left }}
                                    </td>
                                    <td>
                                        <span style="color: {{ $client->status === 'active' ? 'green' : 'red' }};">
                                            {{ $client->status === 'active' ? 'نشط' : 'منتهي' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            <a href="{{ route('captain.edit', $client->id) }}" title="تعديل"
                                                style="color: #ffc107;">✏️</a>
                                            <!-- زر التفعيل/تعطيل -->
                                            <form action="{{ route('captain.toggleStatus', $client->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" title="تفعيل/تعطيل"
                                                    style="color: {{ $client->status === 'active' ? '#28a745' : '#dc3545' }};">
                                                    {{ $client->status === 'active' ? '✅' : '❌' }}
                                                </button>
                                            </form>
                                            <button title="حذف" style="color: #dc3545;">🗑️</button>
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
