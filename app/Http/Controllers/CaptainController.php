<?php

namespace App\Http\Controllers;

use App\interfaces\CaptainServiceInterface;
use Illuminate\Http\Request;

class CaptainController extends Controller
{
    protected $captainService;

    public function __construct(CaptainServiceInterface $captainService)
    {
        $this->captainService = $captainService;
    }

    public function index()
    {
        $captains = $this->captainService->getAllCaptains();

        return view('captains.admin_panel.index', compact('captains'));
    }

    public function create()
    {
        return view('captains.admin_panel.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:20|unique:phones,number',
        ], [
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً، يرجى اختيار بريد آخر.',
            'phone_number.unique' => 'رقم الهاتف مسجل مسبقاً، يرجى اختيار رقم آخر.',
        ]);

        $this->captainService->storeCaptain($validatedData);

        return redirect()->route('admin.captains.index')
            ->with('success', 'تم إضافة الكابتن بنجاح!');
    }

    public function edit($id)
    {
        $captain = $this->captainService->getCaptainById($id);

        if (! $captain) {
            return redirect()->route('admin.captains.index')->with('error', 'الكابتن غير موجود.');
        }

        return view('captains.admin_panel.edit', compact('captain'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone_number' => 'required|string|max:20|unique:phones,number,'.$id.',user_id',
            'password' => 'nullable|string|min:8',
        ]);

        $this->captainService->updateCaptain($id, $validatedData);

        return redirect()->route('admin.captains.index')
            ->with('success', 'تم تعديل بيانات الكابتن بنجاح!');
    }

    public function destroy($id)
    {
        $deleted = $this->captainService->deleteCaptain($id);

        if ($deleted) {
            return redirect()->route('admin.captains.index')->with('success', 'تم حذف الكابتن بنجاح!');
        }

        return redirect()->route('admin.captains.index')->with('error', 'حدث خطأ أثناء الحذف.');
    }
}
