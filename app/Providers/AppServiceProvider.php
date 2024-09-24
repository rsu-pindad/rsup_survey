<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;
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
        // Pulse::user(fn ($user) => [
        //     'name' => $user->name,
        // ]);
        // config(['app.locale' => 'id']);
        // Number::useLocale('id');
        // Carbon::setLocale('id');
        setlocale(LC_ALL, 'id_ID', 'id_ID.UTF-8');
        Cache::flush();
        Session::flush();
        config(['app.locale' => 'id']);
        Number::useLocale('id');
        Carbon::setLocale('id');
    }
}
