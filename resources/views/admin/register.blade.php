<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد | GYM CORE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100 min-h-screen flex items-center justify-center p-4 font-sans">

    <div class="card bg-base-200 w-full max-w-lg border border-base-300 shadow my-8">
        <div class="card-body p-8 space-y-6">
            
            <!-- Logo & Brand Header -->
            <div class="text-center space-y-1">
                <h1 class="text-2xl font-bold tracking-wide text-base-content">GYM CORE</h1>
                <p class="text-xs text-base-content/60">انضم إلينا الآن وابدأ رحلتك الرياضية</p>
            </div>

            <!-- Error Feedback -->
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

            <!-- Register Form -->
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-xs text-base-content">الاسم بالكامل</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="مثال: أحمد محمد" required class="input input-bordered input-sm w-full" />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-xs text-base-content">رقم الهاتف</span>
                    </label>
                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="01xxxxxxxxx" required class="input input-bordered input-sm w-full" />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-xs text-base-content">البريد الإلكتروني</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com" required class="input input-bordered input-sm w-full" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold text-xs text-base-content">كلمة المرور</span>
                        </label>
                        <input type="password" name="password" placeholder="••••••••" required class="input input-bordered input-sm w-full" />
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold text-xs text-base-content">تأكيد كلمة المرور</span>
                        </label>
                        <input type="password" name="password_confirmation" placeholder="••••••••" required class="input input-bordered input-sm w-full" />
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-full btn-sm mt-2">
                    تسجيل الحساب
                </button>
            </form>

            <div class="text-center pt-2 border-t border-base-300">
                <p class="text-xs text-base-content/60">
                    لديك حساب بالفعل؟ <a href="{{ route('show.login') }}" class="link link-primary font-semibold">تسجيل الدخول من هنا</a>
                </p>
            </div>

        </div>
    </div>

</body>
</html>
