<?php

namespace App\Domains\Captain\Actions;

use App\Models\Client;
use Illuminate\Http\Request;

class CaptainService
{
    public function index()
    {
        return view('Captain.index');
    }

    public function store(request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'package_id' => 'nullable', // مؤقتاً شيل exists لحد ما تملأ جدول الباقات
            'phone_number' => 'required|string|unique:clients']);
            $data['password'] = bcrypt('12345678');
            $newclient = Client::create( $data );

            return redirect()->route('captain.index');
    }

    public function create()
    {

        return view('Captain.create');
    }
}
