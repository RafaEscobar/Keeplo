<?php

namespace App\Providers;

use App\Models\Item;
use App\Models\Vahul;
use App\Policies\ItemPolicy;
use App\Policies\VahulPolicy;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Vahul::class => VahulPolicy::class,
        Item::class => ItemPolicy::class
    ];
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
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    }
}
