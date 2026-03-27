<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserType;

class AuthController extends Controller
{
    public function showRegistar()
    {
        return view('admin.register');
    }

    public function showLogin()
    {
        return view('admin.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|unique:phones,number',
            'password' => 'required|min:6|confirmed',
        ]);
        // هذه الدالة تبحث في قاعدة البيانات عن نوع المستخدم 'Client' 
        // وتجلب أول نتيجة تجدها ('first') عشان نقدر نستخدم الـ 'id' الخاص به
        $clientType = UserType::where('name', 'Client')->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type_id' => $clientType ? $clientType->id : 3,
        ]);
        $user->phones()->create(['number' => $request->phone_number]);

        Auth::login($user);

        return redirect('/client/dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $userTypeName = Auth::user()->userType->name ?? 'Client';
            
            if ($userTypeName == 'Admin') {
                return redirect()->route('admin.index');
            } elseif ($userTypeName == 'Captain') {
                return redirect('/captain/dashboard');
            } else {
                return redirect('/client/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
