<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Common\ValueObjects;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidWeekdayValue;

/**
 * Enum Weekday
 *
 * @package ProfessorGradingApp\Domain\Common\ValueObjects
 */
enum Weekday : int
{
    case MONDAY = 1;

    case TUESDAY = 2;

    case WEDNESDAY = 3;

    case THURSDAY = 4;

    case FRIDAY = 5;

    case SATURDAY = 6;

    case SUNDAY = 7;

    /**
     * @param int $value
     * @return static
     * @throws InvalidWeekdayValue
     */
    public static function fromValue(int $value): self
    {
        $cases = array_column(self::cases(), 'value');

        if (!in_array($value, $cases, true))
            throw new InvalidWeekdayValue($value);

        return self::from($value);
    }

    /**
     * @param Weekday $weekday
     * @return bool
     */
    public function equals(self $weekday): bool
    {
        return $this->value() === $weekday->value();
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }
}
