<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\User\ValueObjects;

use ProfessorGradingApp\Domain\User\Exceptions\InvalidPassword;

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
     * @throws InvalidPassword
     */
    public function __construct(string $value)
    {
        $this->ensureIsValidPassword($value);

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
     * @param string $value
     * @return void
     * @throws InvalidPassword
     */
    private function ensureIsValidPassword(string $value): void
    {
        $hasUpperCaseLetters = preg_match('@[A-Z]@', $value);

        if(strlen($value) < 8 || !$hasUpperCaseLetters) {

            throw new InvalidPassword(
                'The password should be at least 8 characters in length and include at least one upper case letter'
            );
        }
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
