<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Order;
use App\Policies\OrderPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
        Gate::define('admin-only', function ($user) {
            return $user->role === 'admin';
        });
    }

    protected $policies = [
        Order::class => OrderPolicy::class,
    ];
}
