<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خطأ في النظام - GYM CORE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100 min-h-screen flex items-center justify-center p-4 font-sans">

    <div class="card bg-base-200 border border-base-300 max-w-md w-full shadow-2xl text-center">
        <div class="card-body p-8 space-y-6 items-center">
            
            <div class="w-20 h-20 rounded-full bg-error/10 text-error flex items-center justify-center text-4xl mb-2">
                🏋️‍♂️
            </div>

            <h1 class="text-2xl font-black text-base-content">عفواً، حدث خطأ غير متوقع!</h1>
            <p class="text-sm text-base-content/70 leading-relaxed">
                نواجه حالياً مشكلة تقنية بسيطة. جاري العمل على حلها بواسطة فريقنا الفني.
            </p>

            <div class="pt-4 w-full">
                <a href="{{ url('/') }}" class="btn btn-primary w-full shadow-lg shadow-primary/20">
                    العودة للرئيسية 🏠
                </a>
            </div>

        </div>
    </div>

</body>
</html>
