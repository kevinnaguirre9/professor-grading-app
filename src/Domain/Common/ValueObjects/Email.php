<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Common\ValueObjects;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidEmailFormat;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidEmailDomain;

/**
 * Class Email
 *
 * @package ProfessorGradingApp\Domain\Common\ValueObjects
 */
abstract class Email
{
    private string $value;

    /**
     * The allowed email domains
     *
     * @var string[]
     */
    protected array $allowedDomains = [];

    /**
     * @param string $value
     * @throws InvalidEmailFormat
     * @throws InvalidEmailDomain
     */
    public function __construct(string $value)
    {
        $this->ensureHasValidEmailFormat($value);

        $this->ensureEmailHasAllowedDomain($value);

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
     * @throws InvalidEmailFormat
     */
    private function ensureHasValidEmailFormat(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
            throw new InvalidEmailFormat($value);
    }

    /**
     * @param string $value
     * @return void
     * @throws InvalidEmailDomain
     */
    public function ensureEmailHasAllowedDomain(string $value): void
    {
        if(empty($this->allowedDomains))
            return;

        $emailFragments = explode('@', $value);

        $domain = array_pop($emailFragments);

        if(!in_array($domain, $this->allowedDomains))
            throw new InvalidEmailDomain($domain, $this->allowedDomains);
    }

    /**
     * @param Email $email
     * @return bool
     */
    public function equals(self $email): bool
    {
        return $this->value() === $email->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
