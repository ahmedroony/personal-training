<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Domains\Captain\Actions\CaptainService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaptainDashboardController extends Controller
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

        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات لوحة التحكم بنجاح',
            'data' => [
                'captain' => $captain,
                'attendances' => $attendances,
                'monthCount' => $monthCount,
                'attendedToday' => $attendedToday
            ]
        ], 200);
    }

    public function checkIn(Request $request)
    {
        $this->captainService->checkIn();
        
        return response()->json([
            'status' => true,
            'message' => 'تم تسجيل حضورك بنجاح! 🎉',
        ], 200);
    }
}
