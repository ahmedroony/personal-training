<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الباقات والأنظمة الغذائية - GYM CORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Admin/manage.css') }}">
</head>

<body>
    <div class="dashboard-container">
        @include('layouts.sidebar')

        <main class="main-content">
            @if(session('success'))
                <div style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; background-color: #198754; color: white; padding: 15px 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.2); font-weight: bold; text-align: center;">
                    {{ session('success') }}
                </div>
            @endif
            <header class="header-section">
                <div>
                    <h1>إدارة الباقات والأنظمة الغذائية</h1>
                    <p>إدارة وعرض وحذف الباقات والأنظمة المتاحة</p>
                </div>
            </header>
            <section class="form-card">
                <h3>📋 قائمة الباقات</h3>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>اسم الباقة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($plans->isEmpty())
                                <tr>
                                    <td colspan="2" style="text-align: center;">لا توجد باقات متاحة حالياً.</td>
                                </tr>
                            @else
                                @foreach ($plans as $plan)
                                <tr class="client-row">
                                    <td>{{ $plan->name ?? 'باقة بدون اسم' }}</td>
                                    <td>
                                        <div class="action-btns" style="display: flex; gap: 10px; align-items: center;">
                                            <form action="{{ route('setting.delete', $plan->id) }}" method="POST" style="margin: 0; display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="حذف" style="color: #dc3545; background: none; border: none; cursor: pointer; font-size: 18px;">🗑️</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="form-card" style="margin-top: 30px;">
                <h3>🥗 قائمة باقات الطعام</h3>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>اسم باقة الطعام</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($dietPlans->isEmpty())
                                <tr>
                                    <td colspan="2" style="text-align: center;">لا توجد باقات طعام متاحة حالياً.</td>
                                </tr>
                            @else
                                @foreach ($dietPlans as $dietPlan)
                                <tr class="client-row">
                                    <td>{{ $dietPlan->name ?? 'باقة بدون اسم' }}</td>
                                    <td>
                                        <div class="action-btns" style="display: flex; gap: 10px; align-items: center;">
                                            <form action="{{ route('setting.diet.delete', $dietPlan->id) }}" method="POST" style="margin: 0; display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="حذف" style="color: #dc3545; background: none; border: none; cursor: pointer; font-size: 18px;">🗑️</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
