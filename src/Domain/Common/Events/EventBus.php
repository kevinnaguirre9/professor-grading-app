<?php

namespace ProfessorGradingApp\Domain\Common\Events;

/**
 * Interface EventBus
 *
 * @package ProfessorGradingApp\Domain\Common\Events
 */
interface EventBus
{
    /**
     * Dispatches an Event
     *
     * @param Event ...$events
     * @return void
     */
    public function dispatch(Event ...$events): void;
}
