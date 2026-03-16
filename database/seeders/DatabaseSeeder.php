<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\UserType;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // دالة "firstOrCreate" مفيدة جداً في لارافيل:
        // هي تقوم بالبحث عن الصف (مثلاً دور "Admin").
        // لو وجدته، ترجعه مباشرةً من الداتا بيز. ولو لم تجده، تقوم بإنشائه أوتوماتيكياً.
        // ده بيحمينا من تكرار البيانات أو حدوث ايرور لو شغلنا السيدر (Seeder) أكتر من مرة.
        $adminType = UserType::firstOrCreate(['name' => 'Admin']);
        $captainType = UserType::firstOrCreate(['name' => 'Captain']);
        $clientType = UserType::firstOrCreate(['name' => 'Client']);

        Plan::firstOrCreate([
            'name' => 'Basic Plan',
            'duration_days' => 30,
            'price' => 0,
            'description' => 'Default Plan'
        ]);
        //before i depoly the site i will remove this user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'user_type_id' => $adminType->id,
        ]);
        User::create([
            'name' => 'Captain User',
            'email' => 'captain@captain.com',
            'password' => bcrypt('12345678'),
            'user_type_id' => $captainType->id,
        ]);
        User::create([
            'name' => 'Regular User',
            'email' => 'regular@regular.com',
            'password' => bcrypt('12345678'),
            'user_type_id' => $clientType->id,
        ]);
        $this->call([
            SubscriptionSeeder::class,
        ]);
    }
}
