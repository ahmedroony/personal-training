@extends('layouts.app')

@php
    $title = 'إضافة كابتن جديد | GYM CORE';
    $headerTitle = 'إضافة كابتن جديد';
@endphp

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="card bg-base-200 border border-base-300">
        <div class="card-body p-6 space-y-6">
            
            <div class="flex items-center justify-between pb-4 border-b border-base-300">
                <div>
                    <h2 class="text-lg font-bold text-base-content">إضافة كابتن جديد</h2>
                    <p class="text-xs text-base-content/60 mt-1">أدخل بيانات المدرب الجديد لإنشاء حسابه</p>
                </div>
                <a href="{{ route('admin.captains.index') }}" class="btn btn-ghost btn-xs">
                    إلغاء
                </a>
            </div>

            @if ($errors->any())
                <div role="alert" class="alert alert-error text-xs py-3">
                    <div>
                        <span class="font-bold">يرجى تصحيح الأخطاء:</span>
                        <ul class="list-disc list-inside mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.captains.store') }}" class="space-y-4">
                @csrf

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-xs text-base-content">اسم الكابتن بالكامل</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="مثال: أحمد محمود" required class="input input-bordered input-sm w-full" />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-xs text-base-content">البريد الإلكتروني</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="captain@gym.com" required class="input input-bordered input-sm w-full" />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-xs text-base-content">رقم الهاتف</span>
                    </label>
                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="01234567890" required class="input input-bordered input-sm w-full" />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-xs text-base-content">كلمة المرور</span>
                    </label>
                    <input type="password" name="password" placeholder="كلمة مرور للدخول (8 أحرف على الأقل)" required class="input input-bordered input-sm w-full" />
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.captains.index') }}" class="btn btn-ghost btn-sm">إلغاء</a>
                    <button type="submit" class="btn btn-primary btn-sm px-6">
                        إضافة الكابتن
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
