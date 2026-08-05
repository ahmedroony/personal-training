@extends('layouts.app')

@php
    $title = 'لوحة التحكم | GYM CORE';
    $headerTitle = 'لوحة التحكم الرئيسية';
@endphp

@section('content')
<div class="space-y-6">

    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-base-200 p-6 rounded-xl border border-base-300">
        <div>
            <h2 class="text-xl font-bold text-base-content">مرحباً، {{ auth()->user()->name }}</h2>
            <p class="text-xs text-base-content/60 mt-1">اضغط على بطاقات الإحصائيات لفلترة المتدربين</p>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Card 1: All -->
        <div id="card-all" onclick="applyFilter('all', this)" class="stat bg-base-200 border border-primary rounded-xl cursor-pointer select-none">
            <div class="stat-title text-xs font-semibold text-base-content/70">إجمالي المتدربين</div>
            <div class="stat-value text-primary mt-1 text-2xl font-bold">{{ $usersCount }}</div>
            <div class="stat-desc text-xs text-base-content/50 mt-1">عرض جميع المشتركين</div>
        </div>

        <!-- Card 2: Active -->
        <div id="card-active" onclick="applyFilter('active', this)" class="stat bg-base-200 border border-base-300 rounded-xl cursor-pointer select-none">
            <div class="stat-title text-xs font-semibold text-base-content/70">المشتركون النشطون</div>
            <div class="stat-value text-success mt-1 text-2xl font-bold">{{ $activeSubscribersCount }}</div>
            <div class="stat-desc text-xs text-base-content/50 mt-1">اشتراك ساري</div>
        </div>

        <!-- Card 3: Inactive -->
        <div id="card-inactive" onclick="applyFilter('inactive', this)" class="stat bg-base-200 border border-base-300 rounded-xl cursor-pointer select-none">
            <div class="stat-title text-xs font-semibold text-base-content/70">الاشتراكات المنتهية</div>
            <div class="stat-value text-error mt-1 text-2xl font-bold">{{ $inactiveSubscribersCount }}</div>
            <div class="stat-desc text-xs text-base-content/50 mt-1">بحاجة للتجديد</div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card bg-base-200 border border-base-300">
        <div class="card-body p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 id="table-title" class="text-base font-bold text-base-content">عرض كل المشتركين</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-base-300/50 text-base-content text-xs">
                            <th class="font-bold">الاسم</th>
                            <th class="font-bold">الحالة</th>
                            <th class="font-bold">الباقة</th>
                            <th class="font-bold">الأيام المتبقية</th>
                            <th class="font-bold">التمرين</th>
                        </tr>
                    </thead>
                    <tbody id="clients-body">
                        @forelse ($users as $user)
                            <tr class="client-row" data-status="{{ ($user->subscription && $user->subscription->is_active) ? 'active' : 'inactive' }}">
                                <td class="font-semibold text-base-content text-sm">
                                    {{ $user->name }}
                                </td>
                                <td>
                                    @if ($user->subscription && $user->subscription->is_active)
                                        <span class="badge badge-success badge-sm font-semibold">نشط</span>
                                    @else
                                        <span class="badge badge-error badge-sm font-semibold">منتهي</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-sm">{{ $user->subscription->plan->name ?? 'بدون باقة' }}</span>
                                </td>
                                <td>
                                    <span class="text-sm font-mono">{{ $user->subscription->remaining_days ?? 0 }} يوم</span>
                                </td>
                                <td>
                                    @if ($user->subscription?->plan?->description)
                                        <div class="dropdown dropdown-bottom dropdown-end">
                                            <div tabindex="0" role="button" class="btn btn-ghost btn-xs text-primary font-medium">عرض التفاصيل</div>
                                            <div tabindex="0" class="dropdown-content z-[10] card card-compact w-64 p-3 shadow bg-base-300 border border-base-100 text-xs text-base-content">
                                                <p class="whitespace-pre-line">{{ $user->subscription->plan->description }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-base-content/40 text-xs">--</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-base-content/50 text-xs">
                                    لا يوجد مشتركين لعرضهم حالياً
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    function applyFilter(status, selectedCard) {
        const rows = document.querySelectorAll('.client-row');
        const cards = [document.getElementById('card-all'), document.getElementById('card-active'), document.getElementById('card-inactive')];
        const title = document.getElementById('table-title');

        cards.forEach(card => {
            if (card) {
                card.classList.remove('border-primary', 'border-success', 'border-error');
                card.classList.add('border-base-300');
            }
        });

        if (status === 'all') {
            selectedCard.classList.remove('border-base-300');
            selectedCard.classList.add('border-primary');
            title.innerText = "عرض كل المشتركين";
        } else if (status === 'active') {
            selectedCard.classList.remove('border-base-300');
            selectedCard.classList.add('border-success');
            title.innerText = "عرض المتدربين النشطين";
        } else if (status === 'inactive') {
            selectedCard.classList.remove('border-base-300');
            selectedCard.classList.add('border-error');
            title.innerText = "عرض الاشتراكات المنتهية";
        }

        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            if (status === 'all' || rowStatus === status) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>
@endsection
