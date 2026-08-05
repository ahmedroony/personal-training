@extends('layouts.app')

@php
    $title = 'إدارة الكباتن | GYM CORE';
    $headerTitle = 'سجل الكباتن والمدربين';
@endphp

@section('content')
<div class="space-y-6">

    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-base-200 p-6 rounded-xl border border-base-300">
        <div>
            <h2 class="text-xl font-bold text-base-content">إدارة الكباتن والمدربين</h2>
            <p class="text-xs text-base-content/60 mt-1">إضافة، تعديل وحذف بيانات طاقم التدريب في الصالة</p>
        </div>
        <div>
            <a href="{{ route('admin.captains.create') }}" class="btn btn-primary btn-sm">
                كابتن جديد +
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card bg-base-200 border border-base-300">
        <div class="card-body p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-base-content">قائمة الكباتن المسجلين</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-base-300/50 text-base-content text-xs">
                            <th class="font-bold">اسم الكابتن</th>
                            <th class="font-bold">البريد الإلكتروني</th>
                            <th class="font-bold">رقم الهاتف</th>
                            <th class="font-bold">الدور</th>
                            <th class="font-bold text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($captains as $captain)
                            <tr class="hover:bg-base-300/30 transition-colors">
                                <td class="font-semibold text-base-content text-sm">
                                    {{ $captain->name }}
                                </td>
                                <td class="text-xs text-base-content/80">{{ $captain->email }}</td>
                                <td dir="ltr" class="text-xs text-base-content/80 text-right">{{ $captain->phones->first()->number ?? 'بدون هاتف' }}</td>
                                <td>
                                    <span class="badge badge-outline badge-sm">كابتن (مدرب)</span>
                                </td>
                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.captains.edit', $captain->id) }}" class="btn btn-ghost btn-xs text-info">
                                            تعديل
                                        </a>
                                        <form action="{{ route('admin.captains.destroy', $captain->id) }}" method="POST" onsubmit="return confirm('هل أنت تأكد من حذف هذا الكابتن؟');" class="inline">
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
                                <td colspan="5" class="text-center py-6 text-base-content/50 text-xs">
                                    لا يوجد كباتن مسجلين حالياً.
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
