<?php

namespace ProfessorGradingApp\Domain\User\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;

/**
 * Class InvalidPassword
 *
 * @package ProfessorGradingApp\Domain\User\Exceptions
 */
final class InvalidPassword extends AbstractCoreException
{
    protected const ERROR_TYPE = 'invalid_password';

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Invalid password.';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return '';
    }
}
