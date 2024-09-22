<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        Config::set('cp', config('control-panel', []));

        Password::defaults(function (): Password {
            return app()->isProduction()
                        ? Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()
                        : Password::min(3);
        });
    }
}
