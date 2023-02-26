<?php

namespace ProfessorGradingApp\Domain\User\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;

/**
 * Class InvalidCredentials
 *
 * @package ProfessorGradingApp\Domain\User\Exceptions
 */
final class InvalidCredentials extends AbstractCoreException
{
    protected const ERROR_TYPE = 'invalid_credentials';

    /**
     * @inheritdoc
     */
    public function title(): string
    {
        return 'Invalid credentials.';
    }

    /**
     * @inheritdoc
     */
    public function detail(): string
    {
        return 'Incorrect password.';
    }
}
