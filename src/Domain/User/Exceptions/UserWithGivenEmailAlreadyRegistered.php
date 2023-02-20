<?php

namespace ProfessorGradingApp\Domain\User\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;

/**
 * Class UserWithGivenEmailAlreadyRegistered
 *
 * @package ProfessorGradingApp\Domain\User\Exceptions
 */
final class UserWithGivenEmailAlreadyRegistered extends AbstractCoreException
{
    protected const ERROR_TYPE = 'user_with_given_email_already_registered';

    private string $errorDetail;

    /**
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->errorDetail = sprintf("%s %s <%s>", $this->title(), $this->detail(), $email);

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Cannot create user.';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
