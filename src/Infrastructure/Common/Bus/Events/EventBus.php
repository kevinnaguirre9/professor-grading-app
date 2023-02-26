<?php

namespace ProfessorGradingApp\Infrastructure\Common\Bus\Events;

use ProfessorGradingApp\Domain\Common\Events\Event;
use ProfessorGradingApp\Domain\Common\Events\EventBus as EventBusInterface;
use Illuminate\Events\Dispatcher as InfrastructureDispatcher;

/**
 * Class EventBus
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Bus\Events
 */
final class EventBus implements EventBusInterface
{
    /**
     * @param InfrastructureDispatcher $dispatcher
     */
    public function __construct(
        private InfrastructureDispatcher $dispatcher,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function dispatch(Event ...$events): void
    {
        foreach ($events as $event) {
            $this->dispatcher->dispatch($event);
        }
    }
}
