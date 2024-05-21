<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use PowerComponents\LivewirePowerGrid\Button;

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
        // if(env('APP_ENV', 'production') == 'production') {
        //     \URL::forceScheme('https');
        // }
        // Button::macro('icon', function (string $name) {
        //     $this->dynamicProperties['icon'] = $name;
        //     return $this;
        // });
    }
}
