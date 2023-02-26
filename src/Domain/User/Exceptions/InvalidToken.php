<?php

namespace ProfessorGradingApp\Domain\User\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;

/**
 * Class InvalidToken
 *
 * @package ProfessorGradingApp\Domain\User\Exceptions
 */
final class InvalidToken extends AbstractCoreException
{
    protected const ERROR_TYPE = 'invalid_token';

    private string $errorDetail;

    /**
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->errorDetail = $message;

        parent::__construct();
    }

    public function title(): string
    {
        return 'Invalid Token.';
    }

    public function detail(): string
    {
        return $this->errorDetail;
    }
}
