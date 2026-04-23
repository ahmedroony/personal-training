<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthValidate\Register;
use App\Http\Requests\AuthValidate\Login;

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

    public function register(Register $request)
    {
        $request->validated();
        $clientType = UserType::where('name', 'Client')->first();
        if(!$clientType){
            throw new \Exception('Client Role not found');
        };
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type_id' => $clientType->id,
        ]);
        $user->phones()->create(['number' => $request->phone_number]);

        Auth::login($user);

        return redirect('/client/dashboard');
    }

    public function login(Login $request)
    {
        $request->validated();
        if (Auth::attempt($request->only('email', 'password'))) {
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
        return redirect()->route('show.login');
    }
}
