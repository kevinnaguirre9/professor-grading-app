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
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return static
     * @throws InvalidRole
     */
    public static function fromValue(string $value): self
    {
        return match ($value) {
            'supervisor' => self::SUPERVISOR,
            'student' => self::STUDENT,
            default => throw new InvalidRole($value),
        };
    }

    /**
     * @return array
     */
    public static function allValues(): array
    {
        return array_column(Role::cases(), 'value');
    }
}
