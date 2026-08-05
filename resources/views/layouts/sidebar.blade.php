<div class="drawer-side z-40">
    <label for="app-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
    <aside class="bg-base-200 text-base-content min-h-screen w-72 p-4 flex flex-col justify-between border-e border-base-300">
        <div>
            <!-- Brand / Logo -->
            <div class="px-3 py-4 mb-4 border-b border-base-300">
                <h1 class="font-bold text-xl tracking-wide text-base-content">GYM CORE</h1>
                <p class="text-xs text-base-content/60">لوحة التحكم الإدارية</p>
            </div>

            <!-- Navigation Links -->
            <ul class="menu w-full gap-1 p-0 text-sm">
                <li class="menu-title text-xs font-semibold text-base-content/50 uppercase px-3 py-1">القائمة الرئيسية</li>
                
                <li>
                    <a href="{{ route('admin.index') }}" class="{{ request()->routeIs('admin.index') ? 'active font-semibold' : '' }}">
                        الرئيسية
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.manage') }}" class="{{ request()->routeIs('admin.manage') ? 'active font-semibold' : '' }}">
                        إدارة العملاء
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.captains.index') }}" class="{{ request()->routeIs('admin.captains.index*') ? 'active font-semibold' : '' }}">
                        إدارة الكباتن
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.captains.attendance') }}" class="{{ request()->routeIs('admin.captains.attendance') ? 'active font-semibold' : '' }}">
                        حضور الكباتن
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.attendance') }}" class="{{ request()->routeIs('admin.attendance') ? 'active font-semibold' : '' }}">
                        سجل حضور العملاء
                    </a>
                </li>

                <li class="menu-title text-xs font-semibold text-base-content/50 uppercase px-3 py-1 mt-4">البرامج والخطط</li>
                
                <li>
                    <a href="{{ route('workout-plan.index') }}" class="{{ request()->routeIs('workout-plan.index') ? 'active font-semibold' : '' }}">
                        جداول التمارين
                    </a>
                </li>
                <li>
                    <a href="{{ route('create_diet_plans.index') }}" class="{{ request()->routeIs('create_diet_plans.index') ? 'active font-semibold' : '' }}">
                        إنشاء باقات الطعام
                    </a>
                </li>
                <li>
                    <a href="{{ route('diet_plans.index') }}" class="{{ request()->routeIs('diet_plans.index') ? 'active font-semibold' : '' }}">
                        تعيين الأنظمة الغذائية
                    </a>
                </li>
                <li>
                    <a href="{{ route('setting.index') }}" class="{{ request()->routeIs('setting.index') ? 'active font-semibold' : '' }}">
                        إدارة الباقات والأنظمة
                    </a>
                </li>
            </ul>
        </div>

        <!-- Footer / Logout -->
        <div class="pt-4 border-t border-base-300 space-y-3">
            <div class="px-3 flex items-center justify-between text-xs">
                <span class="text-base-content/60">{{ auth()->user()->name ?? 'المدير' }}</span>
                <span class="badge badge-sm badge-ghost">Admin</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline btn-error btn-sm w-full">
                    تسجيل الخروج
                </button>
            </form>
        </div>
    </aside>
</div>
