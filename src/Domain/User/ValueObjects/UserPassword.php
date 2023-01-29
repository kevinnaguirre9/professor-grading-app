<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\User\ValueObjects;

/**
 * Class UserPassword
 *
 * @package ProfessorGradingApp\Domain\User\ValueObjects
 */
final class UserPassword
{
    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param UserPassword $other
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
