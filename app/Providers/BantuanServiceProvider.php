<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BantuanServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path() . '/Helpers/Bantuan.php';
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
