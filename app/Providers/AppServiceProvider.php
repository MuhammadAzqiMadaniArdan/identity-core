<?php

namespace App\Providers;

use App\Models\Passport\Client;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        Passport::tokensCan([
            'avera.read' => 'Read Avera app data',
            'avera.write' => 'Write Avera app data',
        ]);
        Passport::tokensExpireIn(now()->addMinutes(15));
        Passport::refreshTokensExpireIn(now()->addDays(7));
        Passport::authorizationView('oauth.authorize');
        Passport::useClientModel(Client::class);
    }
}
