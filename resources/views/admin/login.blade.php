<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول | GYM CORE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100 min-h-screen flex items-center justify-center p-4 font-sans">

    <div class="card bg-base-200 w-full max-w-md border border-base-300 shadow">
        <div class="card-body p-8 space-y-6">
            
            <!-- Logo & Brand Header -->
            <div class="text-center space-y-1">
                <h1 class="text-2xl font-bold tracking-wide text-base-content">GYM CORE</h1>
                <p class="text-xs text-base-content/60">أهلاً بك مجدداً! أدخل بياناتك للمتابعة.</p>
            </div>

            <!-- Error Feedback -->
            @if ($errors->any())
                <div role="alert" class="alert alert-error text-xs py-3">
                    <div>
                        <span class="font-bold">تنبيه:</span>
                        <ul class="list-disc list-inside mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-xs text-base-content">البريد الإلكتروني</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@gym.com" required class="input input-bordered input-sm w-full" />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold text-xs text-base-content">كلمة المرور</span>
                    </label>
                    <input type="password" name="password" placeholder="••••••••" required class="input input-bordered input-sm w-full" />
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="label cursor-pointer gap-2 p-0">
                        <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-xs" />
                        <span class="label-text text-xs text-base-content/80">تذكرني</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-full btn-sm mt-2">
                    دخول للوحة التحكم
                </button>
            </form>

            <div class="text-center pt-2 border-t border-base-300">
                <p class="text-xs text-base-content/60">
                    ليس لديك حساب؟ <a href="{{ route('show.register') }}" class="link link-primary font-semibold">إنشاء حساب جديد</a>
                </p>
            </div>

        </div>
    </div>

</body>
</html>
