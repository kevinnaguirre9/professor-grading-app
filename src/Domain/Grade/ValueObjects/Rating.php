<?php

namespace ProfessorGradingApp\Domain\Grade\ValueObjects;

use ProfessorGradingApp\Domain\Grade\Exceptions\InvalidRating;

/**
 * Enum Rating
 *
 * @package ProfessorGradingApp\Domain\Grade\ValueObjects
 */
enum Rating: int
{
    CASE DID_NOT_ATTEND = 0;

    CASE BAD = 1;

    CASE REGULAR = 2;

    CASE GOOD = 3;

    /**
     * @param int $value
     * @return static
     * @throws InvalidRating
     */
    public static function fromValue(int $value): self
    {
        $cases = self::allValues();

        if (!in_array($value, $cases, true))
            throw new InvalidRating($value);

        return self::from($value);
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public static function allValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
