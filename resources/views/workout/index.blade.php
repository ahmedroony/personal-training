@extends('layouts.app')

@php
    $title = 'جداول التمارين | GYM CORE';
    $headerTitle = 'جداول التمارين';
@endphp

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="card bg-base-200 border border-base-300 shadow-xl">
        <div class="card-body p-6 md:p-8 space-y-6">
            
            <div class="flex items-center justify-between pb-4 border-b border-base-300">
                <div>
                    <h2 class="text-xl font-black text-base-content flex items-center gap-2">
                        <span>🏋️</span> جداول التمارين
                    </h2>
                    <p class="text-xs text-base-content/60 mt-1">اختر متدرب واكتب التمارين أو الملاحظات الخاصة به</p>
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

            <form action="{{ route('workout-plan.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-bold text-base-content">اختر المتدرب</span>
                    </label>
                    <select name="user_id" required class="select select-bordered w-full focus:select-primary">
                        <option value="" disabled selected>-- اختر المتدرب من هنا --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-bold text-base-content">تفاصيل تمرين المشترك</span>
                    </label>
                    <textarea name="description" placeholder="اكتب تفاصيل التمرين هنا..." class="textarea textarea-bordered w-full h-48 focus:textarea-primary"></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary w-full shadow-lg shadow-primary/20">
                        <span>💾</span> حفظ الجدول
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
