<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Common\ValueObjects;

/**
 * Class StringValueObject
 *
 * @package ProfessorGradingApp\Domain\Common\ValueObjects
 */
abstract class StringValueObject
{
    /**
     * @param string $value
     */
    public function __construct(protected string $value)
    {
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param StringValueObject $other
     * @return bool
     */
    public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
