<?php

namespace App\Domains\Captain\Actions;

use App\Models\CaptainAttendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CaptainService
{
    public function getAttendances()
    {
        return CaptainAttendance::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();
    }

    public function getMonthCount()
    {
        return CaptainAttendance::where('user_id', Auth::id())
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->count();
    }

    public function attendedToday()
    {
        return CaptainAttendance::where('user_id', Auth::id())
            ->where('date', Carbon::today())
            ->exists();
    }

    // تسجيل الحضور
    public function checkIn()
    {
        if ($this->attendedToday()) {
            return false;
        }

        CaptainAttendance::create([
            'user_id' => Auth::id(),
            'date'    => Carbon::today(),
            'time'    => Carbon::now()->format('H:i:s'),
        ]);

        return true;
    }
}
