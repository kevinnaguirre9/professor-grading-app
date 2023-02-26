<?php

namespace ProfessorGradingApp\Domain\Common\Exceptions;

/**
 * Class InvalidEmailFormat
 *
 * @package ProfessorGradingApp\Domain\Common\Exceptions
 */
final class InvalidEmailFormat extends AbstractCoreException
{
    protected const ERROR_TYPE = 'invalid_email_format';

    private string $errorDetail;

    /**
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->errorDetail = "<$email> must follow the format example@email.com.";

        parent::__construct();
    }


    public function title(): string
    {
        return 'Invalid email format.';
    }

    public function detail(): string
    {
        return $this->errorDetail;
    }
}
