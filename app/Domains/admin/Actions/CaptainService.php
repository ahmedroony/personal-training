<?php

namespace App\Domains\admin\Actions;

use App\Models\User;
use App\Models\UserType;
class CaptainService
{
    /**
     * جلب كل الكباتن لعرضهم في صفحة الإدارة
     * (role = 1) افترضنا أن دور الكابتن رقمه 1
     */
    public function getAllCaptains()
    {
        return User::whereHas('userType', function($q) {
            $q->where('name', 'Captain');
        })->get();
    }

    /**
     * حفظ كابتن جديد في قاعدة البيانات
     */
    public function storeCaptain(array $data)
    {
        $captain = new User();
        $captain->name = $data['name'];
        $captain->email = $data['email'];
        $captain->password = bcrypt($data['password']);
        $captain->phone_number = $data['phone_number'];
        $captainType = UserType::where('name', 'Captain')->first();
        $captain->user_type_id = $captainType ? $captainType->id : null;
        $captain->save();

        return $captain;
    }

    /**
     * جلب بيانات كابتن محدد للتعديل
     */
    public function getCaptainById($id)
    {
        $captain = User::with('userType')->find($id);
        if (!$captain || ($captain->userType->name ?? '') != 'Captain') {
            return null; 
        }
        return $captain;
    }

    /**
     * تحديث بيانات كابتن معين
     */
    public function updateCaptain($id, array $data)
    {
        $captain = $this->getCaptainById($id);
        
        if (!$captain) {
            return false;
        }

        $captain->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
        ]);

        if (!empty($data['password'])) {
            $captain->update([
                'password' => bcrypt($data['password']),
            ]);
        }

        return $captain;
    }

    public function deleteCaptain($id)
    {
        $captain = $this->getCaptainById($id);
        
        if ($captain) {
            $captain->delete();
            return true;
        }

        return false;
    }
}
