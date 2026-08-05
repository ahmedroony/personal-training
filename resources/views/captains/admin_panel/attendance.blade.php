@extends('layouts.app')

@php
    $title = 'حضور الكباتن | GYM CORE';
    $headerTitle = 'تقرير حضور الكباتن';
@endphp

@section('content')
<div class="space-y-6">

    <!-- Header Card -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-base-200 p-6 rounded-xl border border-base-300">
        <div>
            <h2 class="text-xl font-bold text-base-content">تقرير حضور وانصراف الكباتن</h2>
            <p class="text-xs text-base-content/60 mt-1">مراقبة سجل حضور مدربي وطاقم الصالة الرياضية</p>
        </div>
    </div>

    <!-- Captains List Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($captains as $captain)
            <div class="card bg-base-200 border border-base-300">
                <div class="card-body p-4 flex flex-row items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-base-300 flex items-center justify-center font-bold text-sm">
                        {{ mb_substr($captain->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-semibold text-base-content text-sm">{{ $captain->name }}</h4>
                        <p class="text-xs text-base-content/60" dir="ltr">{{ $captain->phones->first()->number ?? 'بدون هاتف' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Attendance Logs Table -->
    <div class="card bg-base-200 border border-base-300">
        <div class="card-body p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-base-content">سجل الحضور الكامل</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-base-300/50 text-base-content text-xs">
                            <th class="font-bold">الكابتن</th>
                            <th class="font-bold">التاريخ</th>
                            <th class="font-bold">اليوم</th>
                            <th class="font-bold">الوقت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $att)
                            <tr class="hover:bg-base-300/30 transition-colors">
                                <td class="font-semibold text-sm text-base-content">{{ $att->captain->name }}</td>
                                <td class="font-mono text-xs">{{ $att->date->format('Y-m-d') }}</td>
                                <td class="text-xs">{{ $att->date->locale('ar')->isoFormat('dddd') }}</td>
                                <td class="font-mono text-xs">{{ $att->time }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-base-content/50 text-xs">
                                    لم يتم تسجيل أي حضور للكباتن بعد.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($attendances->hasPages())
                <div class="mt-4 flex justify-center">
                    {{ $attendances->links() }}
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
