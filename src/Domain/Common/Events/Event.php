<?php

namespace ProfessorGradingApp\Domain\Common\Events;

use Carbon\CarbonImmutable;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Interface Event
 *
 * @package ProfessorGradingApp\Domain\Common\Events
 */
interface Event extends \JsonSerializable, Arrayable
{
    /**
     * @return EventId
     */
    public function getEventId(): EventId;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return CarbonImmutable
     */
    public function getFiredAt(): CarbonImmutable;
}
