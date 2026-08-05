@extends('layouts.app')

@php
    $title = 'تفاصيل المتدرب | ' . $user->name;
    $headerTitle = 'ملف المتدرب: ' . $user->name;
@endphp

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-xs">
            العودة للوحة التحكم
        </a>
        <a href="{{ route('admin.editClient', $user->id) }}" class="btn btn-warning btn-xs">
            تعديل البيانات
        </a>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Personal Info & Subscription Card -->
        <div class="card bg-base-200 border border-base-300">
            <div class="card-body p-6 space-y-4">
                <h3 class="text-base font-bold text-base-content border-b border-base-300 pb-3">
                    البيانات الأساسية
                </h3>

                <div class="space-y-3">
                    <div class="flex justify-between items-center text-xs py-1 border-b border-base-300/50">
                        <span class="text-base-content/60">رقم الهاتف:</span>
                        <span class="font-semibold text-base-content font-mono" dir="ltr">{{ $user->phone_number }}</span>
                    </div>

                    <div class="flex justify-between items-center text-xs py-1 border-b border-base-300/50">
                        <span class="text-base-content/60">البريد الإلكتروني:</span>
                        <span class="font-semibold text-base-content">{{ $user->email }}</span>
                    </div>

                    <div class="flex justify-between items-center text-xs py-1 border-b border-base-300/50">
                        <span class="text-base-content/60">اسم الباقة:</span>
                        <span class="badge badge-outline badge-sm font-semibold">{{ $user->subscription?->plan?->name ?? 'بدون باقة' }}</span>
                    </div>

                    <div class="flex justify-between items-center text-xs py-1 border-b border-base-300/50">
                        <span class="text-base-content/60">سعر الباقة:</span>
                        <span class="font-semibold text-base-content">{{ $user->subscription?->paid_price ?? 0 }} ج.م</span>
                    </div>

                    <div class="flex justify-between items-center text-xs py-1 border-b border-base-300/50">
                        <span class="text-base-content/60">تاريخ البدء:</span>
                        <span class="font-semibold text-base-content font-mono">{{ $user->subscription?->start_date?->format('Y-m-d') ?? '--' }}</span>
                    </div>

                    <div class="flex justify-between items-center text-xs py-1">
                        <span class="text-base-content/60">تاريخ الانتهاء:</span>
                        <span class="font-semibold text-base-content font-mono">{{ $user->subscription?->end_date?->format('Y-m-d') ?? '--' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workout Plan Card -->
        <div class="card bg-base-200 border border-base-300">
            <div class="card-body p-6 space-y-4">
                <h3 class="text-base font-bold text-base-content border-b border-base-300 pb-3">
                    جدول التمارين
                </h3>

                <div class="bg-base-300/60 p-4 rounded-lg border border-base-300 text-xs leading-relaxed text-base-content/90 whitespace-pre-line min-h-[160px]">
                    {{ $user->subscription->plan->description ?? 'لا يوجد جدول تمارين محدد بعد' }}
                </div>
            </div>
        </div>

        <!-- Diet Plan Card (Full Width) -->
        <div class="card bg-base-200 border border-base-300 lg:col-span-2">
            <div class="card-body p-6 space-y-4">
                <h3 class="text-base font-bold text-base-content border-b border-base-300 pb-3">
                    الأنظمة الغذائية (أحدث الخطط)
                </h3>

                @if($diet = $user->subscription?->diets?->last())
                    <div class="bg-base-300/60 p-4 rounded-lg border border-base-300 space-y-2">
                        <div class="flex items-center justify-between">
                            <h4 class="font-bold text-sm text-base-content">{{ $diet->dietPlan->name }}</h4>
                            <span class="badge badge-ghost badge-xs">نظام غذائي</span>
                        </div>
                        <p class="text-xs text-base-content/80 leading-relaxed">{{ $diet->dietPlan->base_description }}</p>

                        @if($diet->custom_notes)
                            <div class="divider text-xs text-base-content/40 my-2">ملاحظات الكابتن الخاصة</div>
                            <p class="text-xs text-base-content/70 bg-base-300 p-3 rounded border border-base-300">
                                {{ $diet->custom_notes }}
                            </p>
                        @endif
                    </div>
                @else
                    <div class="text-center py-6 text-base-content/50 text-xs">
                        لم يتم تعيين نظام غذائي لهذا المشترك بعد.
                    </div>
                @endif
            </div>
        </div>

    </div>

</div>
@endsection
