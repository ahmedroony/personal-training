<?php

namespace App\Domains\Captain\Actions;

use App\Domains\Client\ModelClient\Client;
use App\Domains\packages\Modelpackages\Package;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CaptainService
{
    public function index()
    {
        $packages = Package::all();
        $clients = Client::all();
        return view('Captain.index', ['clients' => $clients, 'packages' => $packages]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'package_name' => 'required',
            'phone_number' => 'required|unique:clients,phone_number',
            'duration_days' => 'required|integer',
        ]);
        DB::transaction(function () use ($request) {
            $days = (int) $request->duration_days;
            $package = Package::create([
                'name'=>$request->package_name,
                'duration_days'=>$days,
                'price'=>$request->price ?? 0,
                'description'=>'باقة مضافة يدوياً للعميل '.$request->name,
            ]);
            Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => bcrypt('123456789'),
                'package_id' => $package->id,
                'subscription_starts_at' => now(),
                'subscription_ends_at' => now()->addDays($days),
            ]);
        });
        return redirect()->route('captain.index')->with('success', 'تم إضافة العميل والباقة بنجاح');
    }

    public function create()
    {
        return view('Captain.create');
    }

    public function edit($id)
    {
        $packages = Package::all();
        $client = Client::findOrFail($id);
        return view('Captain.edit', ['client' => $client, 'packages' => $packages]);
    }
    public function manage()
    {
        $packages = Package::all();
        $clients = Client::all();
        return view('Captain.manage', ['clients' => $clients], ['packages' => $packages]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|unique:clients,phone_number,' . $id,
            'package_name' => 'required',
            'subscription_starts_at' => 'required|date',
            'subscription_ends_at' => 'required|date',
        ]);
        $client = Client::findOrFail($id);

        $client->update($request->except(['duration_days']));
        return redirect()->route('captain.index')->with('success', 'تم تحديث بيانات العميل والباقة بنجاح');
    }
    public function toggleStatus($id)
    {
        $client = Client::findOrFail($id);
        $client->status = $client->status === 'inactive' ? 'active' : 'inactive';
        $client->save();
        return redirect()->back()->with('success', 'تم تغيير حالة العميل بنجاح');
    }
}
