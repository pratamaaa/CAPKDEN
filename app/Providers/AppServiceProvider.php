<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\UserFiles;


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
    public function boot()
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $userfiles = UserFiles::where('user_id', auth()->id())->first();
                $view->with('userfiles', $userfiles);
            }
        });
    }
}
