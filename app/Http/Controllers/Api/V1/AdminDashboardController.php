<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Domains\admin\Actions\AdminService;

class AdminDashboardController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        $users = $this->adminService->getAllClients();
        $usersCount = $users->count();

        $activeSubscribersCount = $users->filter(function ($user) {
            return $user->subscription && $user->subscription->is_active;
        })->count();
        $inactiveSubscribersCount = $usersCount - $activeSubscribersCount;

        return response()->json([
            'status' => true,
            'message' => 'تم جلب الإحصائيات بنجاح',
            'data' => [
                'total_users' => $usersCount,
                'active_subscribers' => $activeSubscribersCount,
                'inactive_subscribers' => $inactiveSubscribersCount,
                'users' => $users,
            ],
        ], 200);
    }
}
