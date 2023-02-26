<?php

declare(strict_types=1);

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
        $this->errorDetail = "The user email <$email> is already in use.";

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'User cannot be registered.';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
