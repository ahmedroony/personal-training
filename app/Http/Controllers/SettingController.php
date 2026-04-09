<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\interfaces\SettingServiceInterface;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingServiceInterface $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $plans = $this->settingService->getAllPlans();
        $dietPlans = $this->settingService->getAllDietPlans();
        return view('settings.index', compact('plans', 'dietPlans'));
    }

    public function delete($id)
    {
        $this->settingService->deletePlan($id);
        return redirect()->route('setting.index')->with('success', 'تم حذف الباقة بنجاح');
    }

    public function deleteDietPlan($id)
    {
        $this->settingService->deleteDietPlan($id);
        return redirect()->route('setting.index')->with('success', 'تم حذف باقة الطعام بنجاح');
    }
}
