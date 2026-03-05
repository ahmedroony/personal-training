<?php
namespace App\Domains\admin\Actions;
use Illuminate\Http\Request;
use App\Models\User;
class workoutroutines{
    public function index(){
        $users = User::where('role', 2)->with('subscription')->get();
        return $users;
    }

    
    public function updateDescription(array $data)
    {
        $user = User::findOrFail($data['user_id']);
        $subscription = $user->subscription;

        if ($subscription) {
            $subscription->update([
                'description' => $data['description']
            ]);
        }
    }
}
