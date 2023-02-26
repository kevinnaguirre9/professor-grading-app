<?php

namespace App\Providers;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\User\UserId;
use ProfessorGradingApp\Domain\User\Contracts\JwtTokenManager;
use ProfessorGradingApp\Domain\User\Exceptions\UserNotRegistered;
use ProfessorGradingApp\Domain\User\Services\UserFinder;
use Symfony\Component\VarDumper\VarDumper;

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
     * @throws InvalidUuid
     * @throws BindingResolutionException
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {

            //TODO: If we want to be SOLID to the moon and back, this should go in something like an Action
            $bearerToken = $request->bearerToken();
//
            /** @var UserFinder $userFinder */
            $userFinder = $this->app->make(UserFinder::class);

            /** @var JwtTokenManager $tokenManager */
            $tokenManager = $this->app->make(JwtTokenManager::class);

            $token = $tokenManager->decode($bearerToken);

            $tokenUserId = data_get($token, 'user.id') ?? data_get($token, 'sub');

            $User = $userFinder->__invoke(new UserId($tokenUserId));

            if(! $User)
                return null;

            return new GenericUser(
                [
                    'id' => (string) $User->id(),
                    'name' => $User->fullName(),
                    'email' => (string) $User->email(),
                ]
            );
        });
    }
}
