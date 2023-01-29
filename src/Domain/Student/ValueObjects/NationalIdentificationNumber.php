<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Student\ValueObjects;

/**
 * Class NationalIdentificationNumber
 *
 * @package ProfessorGradingApp\Domain\Student\ValueObjects
 */
final class NationalIdentificationNumber
{
    private const FIXED_LENGTH = 10;

    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->validate($value);

        $this->value = $value;
    }

    /**
     * @param string $value
     * @return void
     */
    private function validate(string $value): void
    {
        if (strlen($value) !== self::FIXED_LENGTH)
            throw new \InvalidArgumentException(
                sprintf("National Identification Number must be %d characters long", self::FIXED_LENGTH)
            );
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
