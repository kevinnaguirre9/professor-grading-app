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
abstract class Email extends StringValueObject
{
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

        parent::__construct($value);
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
}
