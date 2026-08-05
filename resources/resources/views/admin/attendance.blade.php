@extends('layouts.app')

@php
    $title = 'سجل حضور المتدربين | GYM CORE';
    $headerTitle = 'سجل حضور المتدربين اليوم';
@endphp

@section('content')
<div class="space-y-6">

    <!-- Header Card -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-base-200 p-6 rounded-2xl border border-base-300 shadow-sm">
        <div>
            <h2 class="text-2xl font-black text-base-content">سجل حضور المتدربين اليوم 📋</h2>
            <p class="text-sm text-base-content/60 mt-1">تحديد وحفظ حضور المشتركين بنقرة واحدة</p>
        </div>
        <div class="badge badge-primary badge-lg font-bold p-3">
            سجل الحضور
        </div>
    </div>

    <!-- Table Section -->
    <div class="card bg-base-200 border border-base-300 shadow-md">
        <div class="card-body p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-base-content">قائمة المتدربين</h3>
                <span class="badge badge-ghost text-xs">Attendance Check</span>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-base-300/50 text-base-content">
                            <th class="font-bold">الاسم</th>
                            <th class="font-bold">حالة الاشتراك</th>
                            <th class="font-bold">آخر حضور</th>
                            <th class="font-bold text-center">إجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="hover:bg-base-300/30 transition-colors">
                                <td class="font-bold text-base-content">
                                    <div class="flex items-center gap-3">
                                        <div class="avatar placeholder">
                                            <div class="bg-neutral text-neutral-content rounded-full w-8 text-xs font-bold">
                                                {{ mb_substr($user->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <span>{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($user->subscription && $user->subscription->is_active)
                                        <span class="badge badge-success badge-sm gap-1 font-semibold">
                                            <span>●</span> نشط
                                        </span>
                                    @else
                                        <span class="badge badge-error badge-sm gap-1 font-semibold">
                                            <span>●</span> منتهي
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-sm font-medium text-base-content/80">
                                        {{ $user->subscription->last_attendance_info ?? 'لا يوجد اشتراك' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($user->subscription && $user->subscription->is_active)
                                        <form action="{{ route('admin.attendance.store', $user->subscription->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm gap-2 text-white shadow-md shadow-success/20">
                                                <span>✅</span> تسجيل حضور
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="btn btn-neutral btn-disabled btn-sm">
                                            جدد اشتراكك
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-8 text-base-content/50">
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
