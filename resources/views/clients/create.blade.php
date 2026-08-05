@extends('layouts.app')

@php
    $title = 'إضافة مشترك جديد | GYM CORE';
    $headerTitle = 'إضافة مشترك جديد';
@endphp

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="card bg-base-200 border border-base-300">
        <div class="card-body p-6 space-y-6">
            
            <div class="flex items-center justify-between pb-4 border-b border-base-300">
                <div>
                    <h2 class="text-lg font-bold text-base-content">إضافة مشترك جديد</h2>
                    <p class="text-xs text-base-content/60 mt-1">قم بتعبئة بيانات المشترك لإنشاء حساب جديد وتعيين باقته</p>
                </div>
                <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-xs">
                    العودة
                </a>
            </div>

            @if ($errors->any())
                <div role="alert" class="alert alert-error text-xs py-3">
                    <div>
                        <span class="font-bold">يرجى تصحيح الأخطاء التالية:</span>
                        <ul class="list-disc list-inside mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.storeClient') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold text-xs text-base-content">اسم المتدرب بالكامل</span>
                        </label>
                        <input type="text" placeholder="مثال: أحمد محمد علي" name="name" value="{{ old('name') }}" required class="input input-bordered input-sm w-full" />
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold text-xs text-base-content">رقم الهاتف</span>
                        </label>
                        <input type="tel" placeholder="01xxxxxxxxx" name="phone" value="{{ old('phone') }}" required class="input input-bordered input-sm w-full" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold text-xs text-base-content">البريد الإلكتروني</span>
                        </label>
                        <input type="email" placeholder="example@mail.com" name="email" value="{{ old('email') }}" required class="input input-bordered input-sm w-full" />
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold text-xs text-base-content">كلمة المرور</span>
                        </label>
                        <input type="password" placeholder="كلمة المرور (8 أرقام على الأقل)" name="password" required class="input input-bordered input-sm w-full" />
                    </div>
                </div>

                <div class="divider text-xs text-base-content/40 my-4">بيانات الاشتراك والباقة</div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-xs text-base-content">اختر باقة موجودة</span>
                    </label>
                    <select name="plan_id" class="select select-bordered select-sm w-full" id="plan_id" onchange="toggleDisplay()">
                        <option value="">-- أو قم بإضافة باقة جديدة بالأسفل --</option>
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->id }}" data-price="{{ $plan->price }}">
                                {{ $plan->name }} ({{ $plan->duration_days }} يوم)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold text-xs text-base-content">اسم الباقة الجديدة</span>
                        </label>
                        <input type="text" id="plan_name" onchange="toggle()" placeholder="مثال: باقة كمال أجسام شهرية" name="name_plan" value="{{ old('name_plan') }}" class="input input-bordered input-sm w-full" />
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold text-xs text-base-content">عدد أيام الاشتراك</span>
                        </label>
                        <input type="number" id="the_duration" placeholder="مثال: 30" name="duration" value="{{ old('duration') }}" class="input input-bordered input-sm w-full" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold text-xs text-base-content">تاريخ بداية الاشتراك</span>
                        </label>
                        <input type="date" name="starts_at" value="{{ old('starts_at', date('Y-m-d')) }}" required class="input input-bordered input-sm w-full" />
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold text-xs text-base-content">تاريخ نهاية الاشتراك</span>
                        </label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}" class="input input-bordered input-sm w-full" />
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold text-xs text-base-content">المبلغ المدفوع</span>
                        </label>
                        <input type="number" step="0.01" id="price" placeholder="مثال: 500" name="price" value="{{ old('price') }}" class="input input-bordered input-sm w-full" />
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-sm">إلغاء</a>
                    <button type="submit" class="btn btn-primary btn-sm px-6">
                        تسجيل وإضافة العميل
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>

<script>
    function toggleDisplay() {
        let planid = document.getElementById('plan_id');
        let price = document.getElementById('price');
        let plan_name = document.getElementById('plan_name');
        let the_duration = document.getElementById('the_duration');
        let getpriceatt = planid.options[planid.selectedIndex].getAttribute('data-price');
        price.value = getpriceatt || '';
        if (planid.value !== "") {
            price.disabled = true;
            plan_name.disabled = true;
            the_duration.disabled = true;
        } else {
            price.disabled = false;
            plan_name.disabled = false;
            the_duration.disabled = false;
        }
    }

    function toggle() {
        let plan_name = document.getElementById('plan_name');
        let planid = document.getElementById('plan_id');
        if (plan_name.value !== "") {
            planid.disabled = true; 
        } else {
            planid.disabled = false;
        }
    }
</script>
@endsection
