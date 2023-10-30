<?php

namespace App\Providers;

use App\Repository\Interfaces\IPetsRepository;
use App\Repository\Interfaces\IUserRepository;
use App\Repository\PetsRepository;
use App\Repository\UserRepository;
use App\Services\Interfaces\IAuthServices;
use App\Services\Interfaces\IPetsServices;
use App\Services\Interfaces\IUserServices;
use App\Services\AuthServices;
use App\Services\PetsServices;
use App\Services\UserServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IPetsRepository::class, PetsRepository::class);
        $this->app->bind(IUserServices::class, UserServices::class);
        $this->app->bind(IPetsServices::class, PetsServices::class);
        $this->app->bind(IAuthServices::class, AuthServices::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IPetsRepository::class, PetsRepository::class);
        $this->app->bind(IUserServcies::class, UserServcies::class);
        $this->app->bind(IPetsServcies::class, PetsServcies::class);
        $this->app->bind(IAuthServcies::class, AuthServcies::class);
    }
}
