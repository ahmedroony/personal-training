@extends('layouts.app')

@php
    $title = 'إدارة العملاء | GYM CORE';
    $headerTitle = 'سجل المشتركين والعملاء';
@endphp

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-base-200 p-6 rounded-xl border border-base-300">
        <div>
            <h2 class="text-xl font-bold text-base-content">سجل العملاء والمشتركين</h2>
            <p class="text-xs text-base-content/60 mt-1">إدارة، بحث وتعديل بيانات متدربي الصالة الرياضية</p>
        </div>
        <div>
            <a href="{{ route('admin.createClient') }}" class="btn btn-primary btn-sm">
                إضافة متدرب +
            </a>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card bg-base-200 border border-base-300">
        <div class="card-body p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-base-content">قائمة المتدربين</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-base-300/50 text-base-content text-xs">
                            <th class="font-bold">المتدرب</th>
                            <th class="font-bold">رقم الهاتف</th>
                            <th class="font-bold">الباقة</th>
                            <th class="font-bold">الأيام المتبقية</th>
                            <th class="font-bold">الحالة</th>
                            <th class="font-bold">التمرين</th>
                            <th class="font-bold text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="hover:bg-base-300/30 transition-colors">
                                <td class="font-semibold text-base-content text-sm">
                                    {{ $user->name }}
                                </td>
                                <td dir="ltr" class="text-xs text-base-content/80 text-right">{{ $user->phones->first()->number ?? 'لا يوجد' }}</td>
                                <td class="text-sm font-medium">{{ $user->subscription->plan->name ?? 'بدون باقة' }}</td>
                                <td>
                                    <span class="text-xs font-mono">{{ $user->subscription->remaining_days ?? 0 }} يوم</span>
                                </td>
                                <td>
                                    @if ($user->subscription && $user->subscription->is_active)
                                        <span class="badge badge-success badge-sm font-semibold">نشط</span>
                                    @else
                                        <span class="badge badge-error badge-sm font-semibold">منتهي</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->subscription?->plan?->description)
                                        <div class="dropdown dropdown-bottom dropdown-end">
                                            <div tabindex="0" role="button" class="btn btn-ghost btn-xs text-primary font-medium">عرض</div>
                                            <div tabindex="0" class="dropdown-content z-[10] card card-compact w-64 p-3 shadow bg-base-300 border border-base-100 text-xs text-base-content">
                                                <p class="whitespace-pre-line">{{ $user->subscription->plan->description }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-base-content/40 text-xs">--</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.client.show', $user->id) }}" class="btn btn-ghost btn-xs text-primary">
                                            التفاصيل
                                        </a>
                                        <a href="{{ route('admin.editClient', $user->id) }}" class="btn btn-ghost btn-xs text-warning">
                                            تعديل
                                        </a>
                                        <form action="{{ route('admin.deleteClient', $user->id) }}" method="POST" onsubmit="return confirm('هل أنت تأكد من حذف هذا العميل؟');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-ghost btn-xs text-error">
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-base-content/50 text-xs">
                                    لا يوجد متدربين حالياً.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
