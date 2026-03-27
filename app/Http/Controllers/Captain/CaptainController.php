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

        return view('domains.captain.dashboard', compact(
            'captain', 'attendances', 'monthCount', 'attendedToday'
        ));
    }

    // تسجيل حضور الكابتن
    public function checkIn(Request $request)
    {
        $this->captainService->checkIn();
        return redirect()->route('captain.dashboard')->with('success', 'تم تسجيل حضورك بنجاح! 🎉');
    }
}
