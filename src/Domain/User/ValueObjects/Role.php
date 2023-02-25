<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\User\ValueObjects;

use ProfessorGradingApp\Domain\User\Exceptions\InvalidRole;

/**
 * Enum Role
 *
 * @package ProfessorGradingApp\Domain\User\ValueObjects
 */
enum Role: string
{
    case SUPERVISOR = 'supervisor';

    case STUDENT = 'student';

    /**
     * @param string $value
     * @return static
     * @throws InvalidRole
     */
    public static function fromValue(string $value): self
    {
        $cases = self::allValues();

        if (!in_array($value, $cases, true))
            throw new InvalidRole($value);

        return self::from($value);
    }

    /**
     * @return bool
     */
    public function isSupervisor(): bool
    {
        return $this->equals(self::SUPERVISOR);
    }

    /**
     * @return bool
     */
    public function isStudent(): bool
    {
        return $this->equals(self::STUDENT);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param Role $other
     * @return bool
     */
    public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    /**
     * @return array
     */
    public static function allValues(): array
    {
        return array_column(Role::cases(), 'value');
    }
}
