<?php

namespace ProfessorGradingApp\Domain\Common\Exceptions;

/**
 * Class InvalidEmailDomain
 *
 * @package ProfessorGradingApp\Domain\Common\Exceptions
 */
final class InvalidEmailDomain extends AbstractCoreException
{
    protected const ERROR_TYPE = 'invalid_email_domain';

    private string $errorDetail;

    /**
     * @param string $emailDomain
     * @param array $allowedDomains
     */
    public function __construct(string $emailDomain, array $allowedDomains)
    {
        $this->errorDetail =  sprintf(
            'Email domain %s is not allowed. Allowed domains are: %s',
            $emailDomain, implode(', ', $allowedDomains)
        );

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Invalid email domain';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
