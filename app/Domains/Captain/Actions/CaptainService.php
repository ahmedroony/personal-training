<?php

namespace App\Domains\Captain\Actions;

use App\Domains\Client\ModelClient\Client;
use App\Domains\packages\Modelpackages\Package;
use Illuminate\Http\Request;

class CaptainService
{
    public function index()
    {
        $packages = Package::all();
        $clients = Client::all();
        return view('Captain.index', ['clients' => $clients, 'packages' => $packages]);
    }

    public function store(request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'package_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'phone_number' => 'required|string|unique:clients',
        ]);
        $data['password'] = bcrypt('12345678');
        Client::create($data);
        return redirect()->route('captain.index');
    }

    public function create()
    {
        return view('Captain.create');
    }

    public function edit($id)
    {
        $packages = Package::all();
        $client = Client::findOrFail($id);
        return view('Captain.edit', ['client' => $client], ['packages' => $packages]);
    }
    public function editpage()
    {
        $packages = Package::all();
        $client = Client::all();
        return view('Captain.edit', ['client' => $client], ['packages' => $packages]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $id,
            'package_name' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:clients,phone_number,' . $id,
        ]);
        return redirect()->route('captain.index');
    }
    public function toggleStatus($id)
    {
        $client = Client::findOrFail($id);
        $client->status = $client->status === 'inactive' ? 'active' : 'inactive';
        $client->save();
        return redirect()->back()->with('success', 'تم تغيير حالة العميل بنجاح');
    }
}
