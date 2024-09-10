<?php

namespace App\Providers;

use App\Models\Attendance;
use App\Observers\AttendanceObserver;
use App\Repositories\IAttendance;
use App\Repositories\IAuth;
use App\Repositories\Implementation\AttendanceRepository;
use App\Repositories\Implementation\AuthRepository;
use App\Adapter\INotification;
use App\Adapter\Implementation\EmailNotificationAdapter;
use App\Repositories\Implementation\NotificationRepository;
use App\Repositories\Implementation\UserRepository;
use App\Repositories\INotificationRepository;
use App\Repositories\IUser;
use App\Services\IAttendanceService;
use App\Services\IAuthService;
use App\Services\Implementation\AttendanceService;
use App\Services\Implementation\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUser::class, UserRepository::class);
        $this->app->bind(IAttendance::class, AttendanceRepository::class);
        $this->app->bind(INotificationRepository::class, NotificationRepository::class);
        $this->app->bind(INotification::class, EmailNotificationAdapter::class);
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IAttendanceService::class, AttendanceService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
