<?php

namespace App\Domains\Captain\Actions;

use App\Domains\Client\ModelClient\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaptainService
{
    public function index()
    {
        $clients = Client::all();
        return view('Captain.index', ['clients' => $clients]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:clients,name',
            'email' => 'required|email|unique:clients,email',
            'subscription_starts_at' => 'required|date',
            'subscription_ends_at' => 'required|date|',
            'duration_days' => 'required|integer',
            'package_name' => 'required|string',
            'phone_number' => 'required|unique:clients,phone_number',
        ]);
            Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'subscription_starts_at' => Carbon::parse($request->subscription_starts_at)->startofDay(),
            'subscription_ends_at' => Carbon::parse($request->subscription_ends_at)->endOfDay(),
            'duration_days' => $request->duration_days,
            'package_name' => $request->package_name,
            ]);

        return redirect()->route('captain.index')->with('success', 'تم إضافة العميل والباقة بنجاح');
    }

    public function create()
    {
        return view('Captain.create');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('Captain.edit', ['client' => $client]);
    }

    public function manage()
    {
        $clients = Client::all();

        return view('Captain.manage', ['clients' => $clients]);
    }

    public function update(Request $request, $id)
    {
    }

    public function toggleStatus($id)
    {
        $client = Client::findOrFail($id);
        $client->status = $client->status === 'inactive' ? 'active' : 'inactive';
        $client->save();

        return redirect()->back()->with('success', 'تم تغيير حالة العميل بنجاح');
    }
}
