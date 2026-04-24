<?php

namespace App\Domains\admin\Actions;

use App\Models\User;
use App\Models\UserType;
use App\interfaces\CaptainServiceInterface;

class CaptainService implements CaptainServiceInterface
{
    public function getAllCaptains()
    {
        return User::whereHas('userType', function($q) {
            $q->where('name', 'Captain');
        })->get();
        
    }

    public function storeCaptain(array $data)
    {
        $captain = new User();
        $captain->name = $data['name'];
        $captain->email = $data['email'];
        $captain->password = bcrypt($data['password']);
        $captainType = UserType::where('name', 'Captain')->first();
        $captain->user_type_id = $captainType ? $captainType->id : null;
        $captain->save();

        $captain->phones()->create(['number' => $data['phone_number']]);

        return $captain;
    }

    /**
     */
    public function getCaptainById($id)
    {
        $captain = User::with(['userType', 'phones'])->find($id);
        if (!$captain || ($captain->userType->name ?? '') != 'Captain') {
            return null;
        }
        return $captain;
    }

    /**
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
        ]);

        $captain->phones()->updateOrCreate(
            ['user_id' => $captain->id],
            ['number' => $data['phone_number']]
        );

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
