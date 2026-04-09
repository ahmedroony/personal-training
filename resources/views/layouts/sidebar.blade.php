<aside class="sidebar" id="sidebar">
    <div class="close-btn" onclick="document.getElementById('sidebar').classList.toggle('show')" style="display: none; cursor: pointer; font-size: 24px; color: #fff; margin-bottom: 20px; text-align: left;">✕</div>
    <div class="logo">GYM CORE</div>
    <nav class="nav-links">
        <a href="{{ route('admin.index') }}" class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">🏠 الرئيسية</a>
        <a href="{{ route('admin.manage') }}" class="{{ request()->routeIs('admin.manage') ? 'active' : '' }}">👤 إدارة العملاء</a>
        <a href="{{ route('admin.captains.index') }}" class="{{ request()->routeIs('admin.captains.index*') ? 'active' : '' }}">👨‍🏫 إدارة الكباتن</a>
        <a href="{{ route('admin.captains.attendance') }}" class="{{ request()->routeIs('admin.captains.attendance') ? 'active' : '' }}">🏅 حضور الكباتن</a>
        <a href="{{ route('admin.attendance') }}" class="{{ request()->routeIs('admin.attendance') ? 'active' : '' }}">📅 سجل حضور العملاء</a>
        <a href="{{ route('workout.index') }}" class="{{ request()->routeIs('workout.index') ? 'active' : '' }}">🏋️ جداول التمارين</a>
        <a href="{{ route('create_diet_plans.index') }}" class="{{ request()->routeIs('create_diet_plans.index') ? 'active' : '' }}">🍳 إنشاء باقات الطعام</a>
        <a href="{{ route('diet_plans.index') }}" class="{{ request()->routeIs('diet_plans.index') ? 'active' : '' }}">🥗 تعيين الأنظمة الغذائية</a>
        <a href="{{ route('setting.index') }}" class="{{ request()->routeIs('setting.index') ? 'active' : '' }}">📦 إدارة الباقات والأنظمة</a>
    </nav>
    <div style="margin-top: auto; padding-top: 20px; border-top: 1px solid #1e1e1e;">
        <p style="font-size: 11px; color: #444; margin-bottom: 8px; text-align: center; letter-spacing: 1px;">ADMIN PANEL</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="width:100%; background: rgba(220,53,69,0.08); border: 1px solid rgba(220,53,69,0.2); color: #dc3545; padding: 10px; border-radius: 10px; cursor: pointer; font-size: 13px; font-family: inherit; transition: 0.25s;" onmouseover="this.style.background='rgba(220,53,69,0.15)'" onmouseout="this.style.background='rgba(220,53,69,0.08)'">
                🚪 تسجيل الخروج
            </button>
        </form>
    </div>
</aside>
