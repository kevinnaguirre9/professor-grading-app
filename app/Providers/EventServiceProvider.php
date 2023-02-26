<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;
use ProfessorGradingApp\Domain\Common\Events\EventBus as EventBusInterface;
use ProfessorGradingApp\Infrastructure\Common\Bus\Events\EventBus as InfrastructureEventBus;

/**
 * Class EventServiceProvider
 *
 * @package App\Providers
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ExampleEvent::class => [
            \App\Listeners\ExampleListener::class,
        ],
    ];

    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->app->bind(EventBusInterface::class, fn($app) => new InfrastructureEventBus($app['events']));
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
