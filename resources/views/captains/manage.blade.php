<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الكباتن - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/admin/manage.css')
    <style>
        .badge.captain {
            background-color: #0d6efd;
            color: white;
        }
        .header-tabs {
            margin-bottom: 20px;
        }
        .header-tabs a {
            padding: 10px 20px;
            color: #ccc;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            margin-left: 15px;
            display: inline-block;
        }
        .header-tabs a.active {
            color: #fff;
            border-bottom: 2px solid #0d6efd;
            font-weight: bold;
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
                    <li class="active"><a href="{{ route('admin.captains.index') }}"> إدارة الكباتن</a></li>
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
                    <h1>سجل الكباتن والمدربين</h1>
                    <p>إدارة، بحث وتعديل بيانات طاقم التدريب في الصالة</p>
                </div>
                <div>
                    <a href="{{ route('admin.captains.create') }}" class="btn-primary">+ كابتن جديد</a>
                </div>
            </header>

            <section class="form-card">
                <h3>🔍 أدوات البحث</h3>
                <div class="filters-grid">
                    <input type="text" placeholder="ابحث باسم الكابتن أو رقم الهاتف..." style="flex: 2;">
                    <button class="btn-primary">بحث</button>
                </div>
            </section>

            <section class="form-card">
                <h3>📋 قائمة الكباتن</h3>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>اسم الكابتن</th>
                                <th>البريد الإلكتروني</th>
                                <th>رقم الهاتف</th>
                                <th>الدور</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($captains as $captain)
                            <tr class="client-row">
                                <td>{{ $captain->name }}</td>
                                <td>{{ $captain->email }}</td>
                                <td dir="ltr" style="text-align: right;">{{ $captain->phone_number }}</td>
                                <td>
                                    <span class="badge captain">مدرب (كابتن)</span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <form action="{{ route('admin.captains.destroy', $captain->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('هل أنت متأكد من حذف هذا الكابتن؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="حذف" style="color: #dc3545; background: #2d2d2d; border: thin; cursor: pointer;">🗑️</button>
                                        </form>
                                        <a href="{{ route('admin.captains.edit', $captain->id) }}" title="تعديل" style="color: #ffc107; text-decoration: none;">✏️</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px;">لا يوجد كباتن مسجلين حالياً. اضغط على "كابتن جديد" لإضافة أول مدرب.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
