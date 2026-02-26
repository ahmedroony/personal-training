<?php

namespace App\Http\Controllers;

use App\Domains\admin\Actions\CaptainService;
use Illuminate\Http\Request;

class CaptainController extends Controller
{
    protected $captainService;

    // بنعمل حقن للسيرفس هنا عشان نستخدمها في كل الدوال
    public function __construct(CaptainService $captainService)
    {
        $this->captainService = $captainService;
    }

    /**
     * عرض صفحة إدارة الكباتن وكل الكباتن الموجودين
     */
    public function index()
    {
        $captains = $this->captainService->getAllCaptains();
        return view('captains.manage', compact('captains'));
    }

    /**
     * عرض صفحة إضافة كابتن جديد
     */
    public function create()
    {
        return view('captains.create');
    }

    /**
     * استلام بيانات الكابتن الجديد وحفظها
     */
    public function store(Request $request)
    {
        // 1. الفاليديشن للبيانات القادمة من الفورم
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:20|unique:users',
        ], [
            // تخصيص رسائل الخطأ لتكون أوضح
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً، يرجى اختيار بريد آخر.',
            'phone_number.unique' => 'رقم الهاتف مسجل مسبقاً، يرجى اختيار رقم آخر.',
        ]);

        // 2. إرسال البيانات للسيرفس لحفظها
        $this->captainService->storeCaptain($validatedData);

        // 3. إعادة توجيه المستخدم لصفحة إدارة الكباتن مع رسالة نجاح
        return redirect()->route('admin.captains.index')
            ->with('success', 'تم إضافة الكابتن بنجاح!');
    }

    /**
     * عرض صفحة تعديل بيانات كابتن
     */
    public function edit($id)
    {
        $captain = $this->captainService->getCaptainById($id);
        
        if (!$captain) {
            return redirect()->route('admin.captains.index')->with('error', 'الكابتن غير موجود.');
        }

        return view('captains.edit', compact('captain'));
    }

    /**
     * استلام التعديلات وتحديث بيانات الكابتن
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone_number' => 'required|string|max:20|unique:users,phone_number,' . $id,
            'password' => 'nullable|string|min:8', // الباسوورد اختياري عند التعديل
        ]);

        $this->captainService->updateCaptain($id, $validatedData);

        return redirect()->route('admin.captains.index')
            ->with('success', 'تم تعديل بيانات الكابتن بنجاح!');
    }

    /**
     * حذف الكابتن
     */
    public function destroy($id)
    {
        $deleted = $this->captainService->deleteCaptain($id);

        if ($deleted) {
            return redirect()->route('admin.captains.index')->with('success', 'تم حذف الكابتن بنجاح!');
        }

        return redirect()->route('admin.captains.index')->with('error', 'حدث خطأ أثناء الحذف.');
    }
}
