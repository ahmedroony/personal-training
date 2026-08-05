<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة المتدرب | GYM CORE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100 text-base-content min-h-screen font-sans">

    <div class="drawer lg:drawer-open">
        <input id="client-drawer" type="checkbox" class="drawer-toggle" />
        
        <div class="drawer-content flex flex-col min-h-screen">
            <!-- Navbar Header -->
            <header class="navbar bg-base-200 border-b border-base-300 px-4 py-3 lg:px-8">
                <div class="flex-none lg:hidden">
                    <label for="client-drawer" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2">
                    <h1 class="text-lg font-bold tracking-tight text-base-content">لوحة المتدرب الشخصية</h1>
                </div>
                <div class="flex-none gap-3">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar border border-base-300">
                            <div class="w-10 rounded-full flex items-center justify-center bg-base-300 text-base-content font-bold">
                                {{ mb_substr($user->name ?? 'M', 0, 1) }}
                            </div>
                        </div>
                        <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-200 rounded-box w-52 border border-base-300">
                            <li class="menu-title px-4 py-2 text-xs text-base-content/60">{{ $user->name ?? 'متدرب' }}</li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="text-error w-full text-start">تسجيل الخروج</button>
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
                    <div role="alert" class="alert alert-success text-xs py-3">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div role="alert" class="alert alert-error text-xs py-3">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Hero Welcome Banner & Action -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-base-200 p-6 rounded-xl border border-base-300">
                    <div>
                        <h2 class="text-xl font-bold text-base-content">مرحباً، {{ $user->name ?? 'متدرب' }}</h2>
                        <p class="text-xs text-base-content/60 mt-1">إليك نظرة سريعة على حالتك الرياضية وسجل حضورك</p>
                    </div>
                    <div>
                        <form action="{{ route('client.checkin') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm text-white">
                                تسجيل حضور اليوم
                            </button>
                        </form>
                    </div>
                </div>

                @php
                    $sub = $user->subscription ?? null;
                @endphp

                <!-- Stats Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="stat bg-base-200 border border-base-300 rounded-xl">
                        <div class="stat-title text-xs font-semibold text-base-content/60">اسم الباقة</div>
                        <div class="stat-value text-base text-base-content truncate mt-1 font-bold">{{ $sub?->plan?->name ?? 'لا توجد باقة' }}</div>
                    </div>

                    <div class="stat bg-base-200 border border-base-300 rounded-xl">
                        <div class="stat-title text-xs font-semibold text-base-content/60">الأيام المتبقية</div>
                        <div class="stat-value text-xl text-warning font-mono mt-1 font-bold">{{ $sub?->remaining_days ?? 0 }} يوم</div>
                    </div>

                    <div class="stat bg-base-200 border border-base-300 rounded-xl">
                        <div class="stat-title text-xs font-semibold text-base-content/60">حالة الاشتراك</div>
                        <div class="stat-value text-base mt-1">
                            @if($sub && $sub->is_active)
                                <span class="badge badge-success badge-sm font-semibold">نشط</span>
                            @else
                                <span class="badge badge-error badge-sm font-semibold">منتهي</span>
                            @endif
                        </div>
                    </div>

                    <div class="stat bg-base-200 border border-base-300 rounded-xl">
                        <div class="stat-title text-xs font-semibold text-base-content/60">تاريخ الانتهاء</div>
                        <div class="stat-value text-xs text-base-content font-mono mt-1">
                            {{ $sub?->end_date?->format('Y-m-d') ?? 'غير محدد' }}
                        </div>
                    </div>
                </div>

                <!-- Two Column Layout: Attendance Log & Diet Plan -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- Attendance Log -->
                    <div class="card bg-base-200 border border-base-300">
                        <div class="card-body p-6 space-y-4">
                            <h3 class="text-base font-bold text-base-content border-b border-base-300 pb-3">
                                سجل الحضور
                            </h3>

                            @if($sub && $sub->attendances->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="table table-zebra w-full">
                                        <thead>
                                            <tr class="bg-base-300/50 text-xs">
                                                <th class="font-bold">#</th>
                                                <th class="font-bold">التاريخ</th>
                                                <th class="font-bold">الوقت</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sub->attendances as $i => $att)
                                                <tr>
                                                    <td class="font-mono font-bold text-xs">{{ $i + 1 }}</td>
                                                    <td class="font-mono text-xs">{{ $att->date->format('Y-m-d') }}</td>
                                                    <td class="font-mono text-xs">{{ $att->time }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-6 text-base-content/50 text-xs">
                                    لا يوجد سجل حضور حالياً
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Diet Plan -->
                    <div class="card bg-base-200 border border-base-300">
                        <div class="card-body p-6 space-y-4">
                            <h3 class="text-base font-bold text-base-content border-b border-base-300 pb-3">
                                النظام الغذائي
                            </h3>

                            @php $latestDiet = $sub?->diets?->last(); @endphp
                            @if($latestDiet)
                                <div class="bg-base-300/60 p-4 rounded-lg border border-base-300 space-y-2">
                                    <h4 class="font-bold text-sm text-base-content">{{ $latestDiet->dietPlan->name }}</h4>
                                    <p class="text-xs text-base-content/80 leading-relaxed">{{ $latestDiet->dietPlan->base_description }}</p>

                                    @if($latestDiet->custom_notes)
                                        <div class="divider text-xs text-base-content/40 my-2">ملاحظات الكابتن</div>
                                        <p class="text-xs text-base-content/70 bg-base-300 p-2 rounded">
                                            {{ $latestDiet->custom_notes }}
                                        </p>
                                    @endif
                                </div>
                            @else
                                <div class="text-center py-6 text-base-content/50 text-xs">
                                    لم يتم تعيين نظام غذائي بعد
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Workout Plan -->
                <div class="card bg-base-200 border border-base-300">
                    <div class="card-body p-6 space-y-4">
                        <h3 class="text-base font-bold text-base-content border-b border-base-300 pb-3">
                            جدول التمارين
                        </h3>

                        @if($sub && $sub->plan && $sub->plan->description)
                            <div class="bg-base-300/60 p-4 rounded-lg border border-base-300 text-xs leading-relaxed whitespace-pre-line text-base-content">
                                {{ $sub->plan->description }}
                            </div>
                        @else
                            <div class="text-center py-6 text-base-content/50 text-xs">
                                لا يوجد جدول تمارين مخصص لهذه الباقة حالياً
                            </div>
                        @endif
                    </div>
                </div>

            </main>
        </div>

        <!-- Drawer Sidebar for Client -->
        <div class="drawer-side z-40">
            <label for="client-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <aside class="bg-base-200 text-base-content min-h-screen w-72 p-4 flex flex-col justify-between border-e border-base-300">
                <div>
                    <div class="px-3 py-4 mb-4 border-b border-base-300">
                        <h1 class="font-bold text-xl tracking-wide text-base-content">GYM CORE</h1>
                        <p class="text-xs text-base-content/60">لوحة المتدرب</p>
                    </div>

                    <ul class="menu w-full p-0 text-sm">
                        <li>
                            <a href="{{ route('client.dashboard') }}" class="active font-semibold">
                                الرئيسية
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="pt-4 border-t border-base-300">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline btn-error btn-sm w-full">
                            تسجيل الخروج
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>

</body>
</html>
