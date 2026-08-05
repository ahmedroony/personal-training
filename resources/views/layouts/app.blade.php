<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'GYM CORE' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100 text-base-content min-h-screen font-sans">
    <div class="drawer lg:drawer-open">
        <input id="app-drawer" type="checkbox" class="drawer-toggle" />
        
        <div class="drawer-content flex flex-col min-h-screen">
            <!-- Navbar Header -->
            <header class="navbar bg-base-200 border-b border-base-300 px-4 py-3 lg:px-8">
                <div class="flex-none lg:hidden">
                    <label for="app-drawer" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2">
                    <h1 class="text-lg font-bold tracking-tight text-base-content">{{ $headerTitle ?? 'لوحة التحكم' }}</h1>
                </div>
                <div class="flex-none gap-3">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar border border-base-300">
                            <div class="w-10 rounded-full flex items-center justify-center bg-base-300 text-base-content font-bold">
                                {{ mb_substr(auth()->user()->name ?? 'A', 0, 1) }}
                            </div>
                        </div>
                        <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-200 rounded-box w-52 border border-base-300">
                            <li class="menu-title px-4 py-2 text-xs text-base-content/60">{{ auth()->user()->name ?? 'مستخدم' }}</li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="text-error w-full text-start">تسجيل الخروج</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Main Page Content -->
            <main class="flex-1 p-4 lg:p-8 space-y-6">
                @if(session('success'))
                    <div role="alert" class="alert alert-success text-sm py-3 shadow-sm">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div role="alert" class="alert alert-error text-sm py-3 shadow-sm">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        @include('layouts.sidebar')
    </div>
</body>
</html>
