<?php

namespace ProfessorGradingApp\Domain\Common\Events;

use Carbon\CarbonImmutable;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;

/**
 * Class DomainEvent
 *
 * @package ProfessorGradingApp\Domain\Common\Events
 */
abstract class DomainEvent implements Event
{
    /**
     * @var String
     */
    protected const NAME = 'event';

    /**
     * @var EventId
     */
    public EventId $eventId;

    /**
     * @var CarbonImmutable
     */
    public CarbonImmutable $firedAt;

    /**
     * @param string|null $eventId
     * @param string|null $firedAt
     * @throws InvalidUuid
     */
    protected function __construct(
        string $eventId = null,
        string $firedAt = null,
    ) {
        $this->eventId = new EventId($eventId);
        $this->firedAt = new CarbonImmutable($firedAt);
    }

    /**
     * @inheritDoc
     */
    public function getEventId(): EventId
    {
        return $this->eventId;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return static::NAME;
    }

    /**
     * @inheritDoc
     */
    public function getFiredAt(): CarbonImmutable
    {
        return $this->firedAt;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
                'uuid'=> (string) $this->eventId,
                'fired_at'=> (string) $this->firedAt,
            ] + $this->toArray();
    }
}
