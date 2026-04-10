<?php

namespace App\Http\Controllers\Captain;

use App\Http\Controllers\Controller;
use App\Domains\Captain\Actions\CaptainService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaptainController extends Controller
{
    protected $captainService;

    public function __construct(CaptainService $captainService)
    {
        $this->captainService = $captainService;
    }

    public function index()
    {
        $captain       = Auth::user();
        $attendances   = $this->captainService->getAttendances();
        $monthCount    = $this->captainService->getMonthCount();
        $attendedToday = $this->captainService->attendedToday();

        $allClients    = $this->captainService->getAllClients();
        $allPlans      = $this->captainService->getActivePlans();
        $myClients     = $this->captainService->getCaptainClients();

        return view('captain.dashboard', compact(
            'captain', 'attendances', 'monthCount', 'attendedToday',
            'allClients', 'allPlans', 'myClients'
        ));
    }

    public function addClient(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'nullable|email|unique:users,email',
            'plan_id' => 'required|exists:plans,id',
        ], [
            'name.required'    => 'من فضلك أدخل اسم المشترك',
            'phone.required'   => 'من فضلك أدخل رقم هاتف المشترك',
            'email.email'      => 'صيغة البريد الإلكتروني غير صحيحة',
            'email.unique'     => 'هذا البريد مسجل مسبقاً في النظام',
            'plan_id.required' => 'من فضلك اختر الباقة التدريبية',
        ]);

        $this->captainService->assignClientToCaptain($request->all());

        return redirect()->route('captain.dashboard')->with('success', 'تم تسجيل المشترك الجديد وإضافته للفريق بنجاح! 💪');
    }

    public function checkIn(Request $request)
    {
        $this->captainService->checkIn();
        return redirect()->route('captain.dashboard')->with('success', 'تم تسجيل حضورك بنجاح! 🎉');
    }
}
