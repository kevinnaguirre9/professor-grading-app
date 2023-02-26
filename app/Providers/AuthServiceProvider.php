<?php

namespace App\Providers;

use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use ProfessorGradingApp\Domain\User\Services\UserFinder;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {

//            $bearerToken = $request->bearerToken();
//
//            /** @var UserFinder $userFinder */
//            $userFinder = $this->app->make(UserFinder::class);
//
//            $user = $userFinder->__invoke()

            if ($request->input('api_token')) {
                return new GenericUser([]);
            }

            return null;
        });
    }
}
