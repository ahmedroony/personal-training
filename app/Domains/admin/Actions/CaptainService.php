<?php

namespace App\Domains\admin\Actions;

use App\Models\User;

class CaptainService
{
    /**
     * جلب كل الكباتن لعرضهم في صفحة الإدارة
     * (role = 1) افترضنا أن دور الكابتن رقمه 1
     */
    public function getAllCaptains()
    {
        return User::where('role', 1)->get();
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
        $captain->role = 1; // 1 = Captain
        $captain->save();

        return $captain;
    }

    /**
     * جلب بيانات كابتن محدد للتعديل
     */
    public function getCaptainById($id)
    {
        $captain = User::find($id);
        if (!$captain || $captain->role != 1) {
            return null; // نعيد قيمة فارغة لو مش موجود أو مش كابتن
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

        // لو تم إدخال كلمة مرور جديدة، نقوم بتحديثها أيضاً
        if (!empty($data['password'])) {
            $captain->update([
                'password' => bcrypt($data['password']),
            ]);
        }

        return $captain;
    }

    /**
     * حذف كابتن
     */
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
