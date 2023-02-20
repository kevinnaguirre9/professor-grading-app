<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Common\ValueObjects;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidTime;

/**
 * Class Time
 *
 * @package ProfessorGradingApp\Domain\Common\ValueObjects
 */
final class Time
{
    /**
     * @var string $time The time represented as a string
     */
    private readonly string $value;

    /**
     * @param string $value
     * @throws InvalidTime
     */
    public function __construct(string $value)
    {
        $this->setTime($value);
    }

    /**
     * @param string $value
     * @throws InvalidTime
     */
    private function setTime(string $value): void
    {
        $datetime = \DateTimeImmutable::createFromFormat('H:i', $value);

        if(!$datetime)
            throw new InvalidTime($value);

        $this->value = $datetime->format('H:i');
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param Time $time
     * @return bool
     */
    public function equals(Time $time): bool
    {
        return $this->value() === $time->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
