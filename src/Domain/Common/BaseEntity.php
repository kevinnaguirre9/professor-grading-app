<?php

namespace ProfessorGradingApp\Domain\Common;

use ProfessorGradingApp\Domain\Common\Events\Event;

/**
 * Class BaseEntity
 *
 * @package ProfessorGradingApp\Domain\Common
 */
abstract class BaseEntity
{
    use IsSerializable;

    /**
     * @var array
     */
    private array $events = [];

    /**
     * @return array
     */
    final public function pullEvents(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }

    /**
     * @param Event $event
     * @return void
     */
    final protected function record(Event $event): void
    {
        $this->events[] = $event;
    }
}
