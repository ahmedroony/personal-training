<?php
// namespace App\Domains\packages\Actions;
// use App\Domains\packages\Modelpackages\Package;
// use Illuminate\Http\Request;
// class PackageService
// {
//     public function store(Request $request)
//     {
//         $data = $request->validate([
//             'name' => 'required|string|max:255',
//             'description' => 'nullable|string',
//             'price' => 'required|numeric',
//         ]);
// }
// public function update(Request $request, $id)
// {
//     $data = $request->validate([
//         'name' => 'required|string|max:255',
//         'description' => 'nullable|string',
//         'price' => 'required|numeric',
//         'duration_days' => 'required|integer',
//     ]);
//     $package = Package::findOrFail($id);
//     $package->update($data);

