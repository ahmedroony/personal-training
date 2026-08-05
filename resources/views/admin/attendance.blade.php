@extends('layouts.app')

@php
    $title = 'سجل حضور المتدربين | GYM CORE';
    $headerTitle = 'سجل حضور المتدربين اليوم';
@endphp

@section('content')
<div class="space-y-6">

    <!-- Header Card -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-base-200 p-6 rounded-xl border border-base-300">
        <div>
            <h2 class="text-xl font-bold text-base-content">سجل حضور المتدربين اليوم</h2>
            <p class="text-xs text-base-content/60 mt-1">تحديد وحفظ حضور المشتركين بنقرة واحدة</p>
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
                            <th class="font-bold">الاسم</th>
                            <th class="font-bold">حالة الاشتراك</th>
                            <th class="font-bold">آخر حضور</th>
                            <th class="font-bold text-center">إجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="hover:bg-base-300/30 transition-colors">
                                <td class="font-semibold text-base-content text-sm">
                                    {{ $user->name }}
                                </td>
                                <td>
                                    @if($user->subscription && $user->subscription->is_active)
                                        <span class="badge badge-success badge-sm font-semibold">نشط</span>
                                    @else
                                        <span class="badge badge-error badge-sm font-semibold">منتهي</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-xs text-base-content/80">
                                        {{ $user->subscription->last_attendance_info ?? 'لا يوجد اشتراك' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($user->subscription && $user->subscription->is_active)
                                        <form action="{{ route('admin.attendance.store', $user->subscription->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-xs text-white">
                                                تسجيل حضور
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="btn btn-neutral btn-disabled btn-xs">
                                            جدد اشتراكك
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-base-content/50 text-xs">
                                    لا يوجد متدربين لعرضهم
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
