<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الكابتن | GYM CORE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100 text-base-content min-h-screen font-sans">

    <div class="drawer lg:drawer-open">
        <input id="captain-drawer" type="checkbox" class="drawer-toggle" />
        
        <div class="drawer-content flex flex-col min-h-screen">
            <!-- Navbar Header -->
            <header class="navbar bg-base-200 border-b border-base-300 px-4 py-3 lg:px-8">
                <div class="flex-none lg:hidden">
                    <label for="captain-drawer" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2">
                    <h1 class="text-xl font-bold tracking-tight text-base-content">لوحة تحكم الكابتن</h1>
                </div>
                <div class="flex-none gap-3">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar border border-primary/30">
                            <div class="w-10 rounded-full flex items-center justify-center bg-primary text-primary-content font-bold">
                                {{ mb_substr($captain->name ?? 'C', 0, 1) }}
                            </div>
                        </div>
                        <ul tabindex="0" class="mt-3 z-[1] p-2 shadow-xl menu menu-sm dropdown-content bg-base-200 rounded-box w-52 border border-base-300">
                            <li class="menu-title px-4 py-2 text-xs text-base-content/60">👋 كابتن {{ $captain->name }}</li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="text-error w-full text-start flex items-center gap-2">
                                        <span>🚪</span> تسجيل الخروج
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 p-4 lg:p-8 space-y-6">

                <!-- Alert Messages -->
                @if(session('success'))
                    <div role="alert" class="alert alert-success shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Checkin Banner Card -->
                <div class="card bg-base-200 border border-base-300 shadow-md">
                    <div class="card-body p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                        @if($attendedToday)
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-success/10 text-success text-3xl flex items-center justify-center">
                                    ✅
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-base-content">سجّلت حضورك النهارده!</h3>
                                    <p class="text-xs text-base-content/60 mt-1">أداء ممتاز، استمر في المتابعة! 🔥</p>
                                </div>
                            </div>
                            <span class="badge badge-success badge-lg font-bold gap-1 p-4">
                                <span>●</span> حاضر اليوم
                            </span>
                        @else
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-warning/10 text-warning text-3xl flex items-center justify-center">
                                    ⏰
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-base-content">لم تسجّل حضورك بعد</h3>
                                    <p class="text-xs text-base-content/60 mt-1">اضغط على الزر لتسجيل وجودك في الجيم اليوم</p>
                                </div>
                            </div>
                            <form action="{{ route('captain.checkin') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning shadow-lg shadow-warning/20 gap-2">
                                    <span>📍</span> سجّل حضوري الآن
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="stat bg-base-200 border border-base-300 rounded-2xl shadow-sm">
                        <div class="stat-figure text-primary text-3xl">📅</div>
                        <div class="stat-title text-xs font-bold text-base-content/60">أيام الحضور هذا الشهر</div>
                        <div class="stat-value text-primary font-mono mt-1">{{ $monthCount }} يوم</div>
                    </div>

                    <div class="stat bg-base-200 border border-base-300 rounded-2xl shadow-sm">
                        <div class="stat-figure text-info text-3xl">📊</div>
                        <div class="stat-title text-xs font-bold text-base-content/60">إجمالي أيام الحضور</div>
                        <div class="stat-value text-info font-mono mt-1">{{ $attendances->count() }} يوم</div>
                    </div>

                    <div class="stat bg-base-200 border border-base-300 rounded-2xl shadow-sm">
                        <div class="stat-figure text-3xl">🗓️</div>
                        <div class="stat-title text-xs font-bold text-base-content/60">حالة اليوم</div>
                        <div class="stat-value text-lg mt-1">
                            @if($attendedToday)
                                <span class="badge badge-success font-bold">حاضر ✅</span>
                            @else
                                <span class="badge badge-warning font-bold">لم يسجّل بعد ⏳</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Add Client Form Section -->
                <div class="card bg-base-200 border border-base-300 shadow-md">
                    <div class="card-body p-6 space-y-4">
                        <h3 class="text-xl font-bold text-base-content flex items-center gap-2 border-b border-base-300 pb-3">
                            <span>👥</span> إدارة المشتركين في فريقك
                        </h3>

                        <div class="bg-base-300/40 p-5 rounded-xl border border-base-300 space-y-4">
                            <h4 class="font-bold text-sm text-base-content">➕ إضافة مشترك جديد للفريق</h4>
                            <form action="{{ route('captain.addClient') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">
                                @csrf
                                <div class="form-control w-full">
                                    <label class="label p-1"><span class="label-text text-xs font-bold">اسم المشترك</span></label>
                                    <input type="text" name="name" required placeholder="الاسم كامل" class="input input-bordered input-sm w-full" />
                                </div>
                                <div class="form-control w-full">
                                    <label class="label p-1"><span class="label-text text-xs font-bold">البريد الإلكتروني</span></label>
                                    <input type="email" name="email" placeholder="example@mail.com" class="input input-bordered input-sm w-full" />
                                </div>
                                <div class="form-control w-full">
                                    <label class="label p-1"><span class="label-text text-xs font-bold">رقم الهاتف</span></label>
                                    <input type="text" name="phone" required placeholder="01xxxxxxxxx" class="input input-bordered input-sm w-full" />
                                </div>
                                <div class="form-control w-full">
                                    <label class="label p-1"><span class="label-text text-xs font-bold">اختر الباقة</span></label>
                                    <select name="plan_id" required class="select select-bordered select-sm w-full">
                                        <option value="" disabled selected>اختر باقة التدريب...</option>
                                        @foreach($allPlans as $plan)
                                            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="sm:col-span-2 md:col-span-4 flex justify-end">
                                    <button type="submit" class="btn btn-primary btn-sm px-6 shadow-md">
                                        <span>✅</span> إضافة للفريق
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Current Clients Table -->
                        <div class="space-y-3 pt-2">
                            <h4 class="font-bold text-sm text-base-content">📋 مشتركينا الحاليين</h4>
                            @if($myClients->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="table table-zebra w-full">
                                        <thead>
                                            <tr class="bg-base-300/50">
                                                <th class="font-bold">اسم المشترك</th>
                                                <th class="font-bold">الباقة</th>
                                                <th class="font-bold">تاريخ الانتهاء</th>
                                                <th class="font-bold">الأيام المتبقية</th>
                                                <th class="font-bold">الحالة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($myClients as $myClient)
                                                <tr>
                                                    <td class="font-bold text-base-content">{{ $myClient->name }}</td>
                                                    <td class="text-sm">{{ $myClient->subscription->plan->name ?? 'بدون باقة' }}</td>
                                                    <td class="font-mono text-sm">{{ $myClient->subscription && $myClient->subscription->end_date ? $myClient->subscription->end_date->format('Y-m-d') : '-' }}</td>
                                                    <td class="font-mono text-sm">{{ $myClient->subscription->remaining_days ?? 0 }} يوم</td>
                                                    <td>
                                                        @if($myClient->subscription && $myClient->subscription->is_active)
                                                            <span class="badge badge-success badge-sm font-bold">نشط</span>
                                                        @else
                                                            <span class="badge badge-error badge-sm font-bold">منتهي</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-8 text-base-content/50">
                                    <span class="text-3xl block mb-2">👥</span>
                                    <p>لا يوجد مشتركين مرتبطين بك حالياً. ابدأ بإضافة أول مشترك!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Captain Attendance Full Log -->
                <div class="card bg-base-200 border border-base-300 shadow-md">
                    <div class="card-body p-6 space-y-4">
                        <h3 class="text-xl font-bold text-base-content flex items-center gap-2 border-b border-base-300 pb-3">
                            <span>📋</span> سجل حضور الكابتن الكامل
                        </h3>

                        @if($attendances->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="table table-zebra w-full">
                                    <thead>
                                        <tr class="bg-base-300/50">
                                            <th class="font-bold">#</th>
                                            <th class="font-bold">التاريخ</th>
                                            <th class="font-bold">اليوم</th>
                                            <th class="font-bold">وقت الحضور</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attendances as $i => $att)
                                            <tr>
                                                <td class="font-mono font-bold">{{ $i + 1 }}</td>
                                                <td class="font-mono">{{ $att->date->format('Y-m-d') }}</td>
                                                <td><span class="badge badge-ghost badge-sm">{{ $att->date->locale('ar')->isoFormat('dddd') }}</span></td>
                                                <td class="font-mono text-sm">{{ $att->time }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8 text-base-content/50">
                                <span class="text-3xl block mb-2">📭</span>
                                <p>لا يوجد سجل حضور حالياً</p>
                            </div>
                        @endif
                    </div>
                </div>

            </main>
        </div>

        <!-- Captain Drawer Sidebar -->
        <div class="drawer-side z-40">
            <label for="captain-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <aside class="bg-base-200 text-base-content min-h-screen w-72 p-4 flex flex-col justify-between border-e border-base-300 shadow-xl">
                <div>
                    <div class="flex items-center gap-3 px-3 py-4 mb-4 border-b border-base-300">
                        <div class="w-10 h-10 rounded-xl bg-primary text-primary-content flex items-center justify-center font-black text-xl shadow-lg shadow-primary/30">
                            🏋️
                        </div>
                        <div>
                            <h1 class="font-extrabold text-lg tracking-wider text-base-content">GYM CORE</h1>
                            <p class="text-xs text-base-content/60 font-medium">لوحة الكابتن</p>
                        </div>
                    </div>

                    <ul class="menu menu-md w-full gap-1 p-0">
                        <li>
                            <a href="{{ route('captain.dashboard') }}" class="active font-bold text-primary-content bg-primary">
                                <span>🏠</span> الرئيسية
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="pt-4 border-t border-base-300">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline btn-error btn-sm w-full gap-2">
                            <span>🚪</span> تسجيل الخروج
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>

</body>
</html>
