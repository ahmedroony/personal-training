<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الكباتن - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/captains/manage.css') }}">
</head>

<body>
    <div class="dashboard-container">
        @include('layouts.sidebar')

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
                                        <form action="{{ route('admin.captains.destroy', $captain->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="حذف" class="btn-delete">🗑️</button>
                                        </form>
                                        <a href="{{ route('admin.captains.edit', $captain->id) }}" title="تعديل" class="btn-edit">✏️</a>
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
