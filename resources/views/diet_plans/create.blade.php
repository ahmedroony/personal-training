@extends('layouts.app')

@php
    $title = 'إنشاء خطة غذائية | GYM CORE';
    $headerTitle = 'إنشاء خطة غذائية جديدة';
@endphp

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Form Card -->
    <div class="card bg-base-200 border border-base-300 shadow-xl">
        <div class="card-body p-6 md:p-8 space-y-6">
            
            <div class="flex items-center justify-between pb-4 border-b border-base-300">
                <div>
                    <h2 class="text-xl font-black text-base-content flex items-center gap-2">
                        <span>🍳</span> إنشاء خطة غذائية جديدة
                    </h2>
                    <p class="text-xs text-base-content/60 mt-1">أضف خطة غذائية جديدة لإعادة استخدامها مع المتدربين</p>
                </div>
            </div>

            @if ($errors->any())
                <div role="alert" class="alert alert-error shadow-sm text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
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

            <form action="{{ route('create_diet_plans.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-bold text-base-content">اسم الخطة الغذائية</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="مثال: خطة التضخم - 3000 سعرة" required class="input input-bordered w-full focus:input-primary" />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-bold text-base-content">وصف الخطة الغذائية</span>
                    </label>
                    <textarea name="base_description" placeholder="اكتب تفاصيل الخطة الغذائية هنا... (الوجبات، السعرات، التوقيت)" required class="textarea textarea-bordered w-full h-44 focus:textarea-primary">{{ old('base_description') }}</textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary w-full shadow-lg shadow-primary/20">
                        <span>💾</span> حفظ الخطة الغذائية
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Existing Diet Plans List Card -->
    <div class="card bg-base-200 border border-base-300 shadow-md">
        <div class="card-body p-6 space-y-4">
            <h3 class="text-lg font-bold text-base-content flex items-center gap-2 border-b border-base-300 pb-3">
                <span>📂</span> الخطط الغذائية الحالية
            </h3>

            <div class="space-y-3">
                @forelse ($dietPlans as $plan)
                    <div class="bg-base-300/50 p-4 rounded-xl border border-base-300 hover:border-primary/40 transition-colors">
                        <h4 class="font-bold text-base-content flex items-center gap-2">
                            <span>🥗</span> {{ $plan->name }}
                        </h4>
                        <p class="text-xs text-base-content/70 mt-2 leading-relaxed whitespace-pre-line">{{ $plan->base_description }}</p>
                    </div>
                @empty
                    <p class="text-center py-6 text-base-content/50 text-sm">لا يوجد خطط غذائية مضافة حتى الآن.</p>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection
