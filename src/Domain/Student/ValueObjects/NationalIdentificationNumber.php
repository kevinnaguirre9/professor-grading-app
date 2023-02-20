<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Student\ValueObjects;

use ProfessorGradingApp\Domain\Common\ValueObjects\StringValueObject;

/**
 * Class NationalIdentificationNumber
 *
 * @package ProfessorGradingApp\Domain\Student\ValueObjects
 */
final class NationalIdentificationNumber extends StringValueObject
{
    private const FIXED_LENGTH = 10;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->validate($value);

        parent::__construct($value);
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
}
