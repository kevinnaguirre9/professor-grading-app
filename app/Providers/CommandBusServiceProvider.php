<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\CommandBus;
use ProfessorGradingApp\Infrastructure\Common\Bus\Command\CommandBusFactory;
use ProfessorGradingApp\Infrastructure\Common\Bus\Command\SyncCommandBus;

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

        $this->app->bind(CommandBus::class, SyncCommandBus::class);
    }
}
