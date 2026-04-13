<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CaptainAttendance;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function attendance()
    {
        $users = User::whereHas('userType', function ($query) {
            $query->where('name', 'Client');
        })->with(['subscription.attendances' => function ($query) {
            $query->latest()->limit(1);
        }])->get();

        return response()->json([
            'status' => true,
            'message' => 'تم جلب حضور المتدربين بنجاح',
            'data' => [
                'users' => $users
            ]
        ], 200);
    }

    public function storeAttendance($subscription_id)
    {
        $subscription = Subscription::findOrFail($subscription_id);

        $subscription->attendances()->create([
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم تسجيل الحضور بنجاح!',
            'data' => [
                'subscription_id' => $subscription_id
            ]
        ], 201);
    }

    public function captainAttendance()
    {
        $captains = User::whereHas('userType', function ($q) {
            $q->where('name', 'Captain');
        })->with(['phones'])->get();

        $attendances = CaptainAttendance::with('captain')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(15);

        return response()->json([
            'status' => true,
            'message' => 'تم جلب حضور الكباتن بنجاح',
            'data' => [
                'captains' => $captains,
                'attendances' => $attendances
            ]
        ], 200);
    }
}
