<?php

namespace App\Domains\admin\Actions;

use App\interfaces\AdminServiceInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminService implements AdminServiceInterface
{
    public function index()
    {
        $users = User::all();
        return $users;
    }

    public function getAllClients()
    {
        // نجلب المستخدمين اللي نوعهم عميل (role = 2) مع اشتراكاتهم
        $users = User::where('role', 2)->with('subscription')->get();
        // نعدل على شكل البيانات عشان تكون جاهزة للـ View
        foreach ($users as $user) {
            $sub = $user->subscription;
            $user->name_plan = $sub ? $sub->name_plan : 'لا يوجد اشتراك';
            $user->total_days = $sub ? $sub->duration : 0;
            $user->remaining_days = $sub ? $sub->remaining_days : 0;
            $user->current_status = ($sub && $sub->is_active) ? 'active' : 'inactive';
        }

        return $users;
    }

    public function createClient() {}

    public function mange() {}

    public function storeClient(array $data)
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->phone_number = $data['phone'];
        $user->role = 2;
        $user->save();
        $endsAt = Carbon::parse($data['starts_at'])->addDays((int) $data['duration']);

        $user->subscriptions()->create([
            'name_plan' => $data['name_plan'],
            'starts_at' => $data['starts_at'],
            'ends_at' => $endsAt,
            'status' => 'active',
            'description' => $data['description'] ?? 'new subscription',
            'price' => $data['price'] ?? 0,
            'duration' => $data['duration'] ?? 30,
        ]);

        return $user;
    }

    public function editClient($id)
    {
        $user = User::find($id);
        if (! $user || $user->role != 2) {
            return null; // أو ترجع رسالة خطأ حسب التصميم
        }
        return $user;
    }

    public function updateClient($id,array $data)
    {
        $user = User::find($id);
        if (!$user || $user->role != 2) {
            return null;
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
        ]);
        $subscription = $user->subscription;
        if ($subscription) {
            $updateData = [
                'name_plan' => $data['name_plan'],
                'duration'  => $data['duration'],
            ];

            if ($subscription->starts_at) {
                // نحسب تاريخ الانتهاء بناءً على تاريخ البداية الأصلي عشان الأيام تتخصم صح
                $updateData['ends_at'] = $subscription->starts_at->copy()->addDays((int) $data['duration']);
            } else {
                $updateData['ends_at'] = \Carbon\Carbon::today()->addDays((int) $data['duration']);
            }

            $subscription->update($updateData);
        } else {
            $newEndDate = \Carbon\Carbon::today()->addDays((int) $data['duration']);
            $user->subscriptions()->create([
                'name_plan' => $data['name_plan'],
                'duration'  => $data['duration'],
                'starts_at' => \Carbon\Carbon::today(),
                'ends_at'   => $newEndDate,
                'status'    => 'active',
            ]);
        }
        return $user;
    }

    public function deleteClient($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();

            return true;
        }

        return false;
    }

    public function getClientById($id)
    {
        return User::where('role', 2)
            ->with(['subscription', 'dietPlans'])
            ->findOrFail($id);
    }
}
