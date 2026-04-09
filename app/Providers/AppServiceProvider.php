<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\interfaces\AdminServiceInterface;
use App\Domains\admin\Actions\AdminService;
use App\interfaces\CaptainServiceInterface;
use App\Domains\admin\Actions\CaptainService;
use App\interfaces\DietPlanServiceInterface;
use App\Domains\admin\Actions\DietPlanService;
use App\interfaces\UserDietPlanServiceInterface;
use App\Domains\admin\Actions\UserDietPlanService;
use App\interfaces\WorkoutRoutinesServiceInterface;
use App\Domains\admin\Actions\WorkoutRoutinesService;
use App\interfaces\SettingServiceInterface;
use App\Domains\Settings\Actions\SettingService;
use App\interfaces\SubscriptionInterface;
use App\Domains\Subscription\Actions\SubscriptionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdminServiceInterface::class, AdminService::class);
        $this->app->bind(CaptainServiceInterface::class, CaptainService::class);
        $this->app->bind(DietPlanServiceInterface::class, DietPlanService::class);
        $this->app->bind(UserDietPlanServiceInterface::class, UserDietPlanService::class);
        $this->app->bind(WorkoutRoutinesServiceInterface::class, WorkoutRoutinesService::class);
        $this->app->bind(SettingServiceInterface::class, SettingService::class);
        $this->app->bind(SubscriptionInterface::class, SubscriptionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
