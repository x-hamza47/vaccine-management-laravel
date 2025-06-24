<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin-view',function($user){
            return $user->role == 'admin';
        });
        Gate::define('hospital-view',function($user){
            return $user->role == 'hospital';
        });
        Gate::define('parent-view',function($user){
            return $user->role == 'parent';
        });
    }
}
