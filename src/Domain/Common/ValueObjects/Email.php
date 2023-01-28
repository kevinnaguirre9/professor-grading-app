<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Common\ValueObjects;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidEmail;

/**
 * Class Email
 *
 * @package ProfessorGradingApp\Domain\Common\ValueObjects
 */
abstract class Email
{
    private string $value;

    /**
     * @param string $value
     * @throws InvalidEmail
     */
    public function __construct(string $value)
    {
        $this->ensureIsValidEmail($value);

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
     * @throws InvalidEmail
     */
    private function ensureIsValidEmail(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
            throw new InvalidEmail('Invalid email');
    }

    /**
     * @param Email $email
     * @return bool
     */
    public function equals(self $email): bool
    {
        return $this->value() === $email->value();
    }
}
