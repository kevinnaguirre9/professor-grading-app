<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ProfessorGradingApp\Infrastructure\Common\Bus\Command\CommandBusFactory;

/**
 * Class CommandBusServiceProvider
 *
 * @package App\Providers
 */
class CommandBusServiceProvider  extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'League\Tactician\CommandBus', function ($app) {
                return (new CommandBusFactory)($app);
            }
        );
    }
}
