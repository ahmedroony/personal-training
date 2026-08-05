@extends('layouts.app')

@php
    $title = 'إدارة الباقات والأنظمة | GYM CORE';
    $headerTitle = 'إدارة الباقات والأنظمة الغذائية';
@endphp

@section('content')
<div class="space-y-6">

    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-base-200 p-6 rounded-2xl border border-base-300 shadow-sm">
        <div>
            <h2 class="text-2xl font-black text-base-content">إدارة الباقات والأنظمة الغذائية 📦</h2>
            <p class="text-sm text-base-content/60 mt-1">عرض، متابعة وحذف الباقات والأنظمة المتاحة في النظام</p>
        </div>
        <div class="badge badge-primary badge-lg font-bold p-3">
            الإعدادات والباقات
        </div>
    </div>

    <!-- Plans Table -->
    <div class="card bg-base-200 border border-base-300 shadow-md">
        <div class="card-body p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-base-content flex items-center gap-2">
                    <span>📋</span> قائمة باقات الاشتراك
                </h3>
                <span class="badge badge-ghost text-xs">Training Plans</span>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-base-300/50 text-base-content">
                            <th class="font-bold">اسم الباقة</th>
                            <th class="font-bold text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($plans as $plan)
                            <tr class="hover:bg-base-300/30 transition-colors">
                                <td class="font-bold text-base-content flex items-center gap-2">
                                    <span>🏋️</span> {{ $plan->name ?? 'باقة بدون اسم' }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('setting.delete', $plan->id) }}" method="POST" onsubmit="return confirm('هل أنت تأكد من حذف هذه الباقة؟');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="حذف" class="btn btn-square btn-ghost btn-sm text-error hover:bg-error/10">
                                            🗑️
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center py-8 text-base-content/50">
                                    لا توجد باقات متاحة حالياً.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Diet Plans Table -->
    <div class="card bg-base-200 border border-base-300 shadow-md">
        <div class="card-body p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-base-content flex items-center gap-2">
                    <span>🥗</span> قائمة باقات الطعام
                </h3>
                <span class="badge badge-ghost text-xs">Diet Plans</span>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-base-300/50 text-base-content">
                            <th class="font-bold">اسم باقة الطعام</th>
                            <th class="font-bold text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dietPlans as $dietPlan)
                            <tr class="hover:bg-base-300/30 transition-colors">
                                <td class="font-bold text-base-content flex items-center gap-2">
                                    <span>🍳</span> {{ $dietPlan->name ?? 'باقة بدون اسم' }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('setting.diet.delete', $dietPlan->id) }}" method="POST" onsubmit="return confirm('هل أنت تأكد من حذف باقة الطعام هذه؟');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="حذف" class="btn btn-square btn-ghost btn-sm text-error hover:bg-error/10">
                                            🗑️
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center py-8 text-base-content/50">
                                    لا توجد باقات طعام متاحة حالياً.
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
