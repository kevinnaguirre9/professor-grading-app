<?php

namespace ProfessorGradingApp\Domain\User\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;
use ProfessorGradingApp\Domain\Common\ValueObjects\User\UserId;

/**
 * Class UserNotRegistered
 *
 * @package ProfessorGradingApp\Domain\User\Exceptions
 */
final class UserNotRegistered extends AbstractCoreException
{
    protected const ERROR_TYPE = 'user_not_registered';

    private string $errorDetail;

    /**
     * @param UserId $userId
     */
    public function __construct(UserId $userId)
    {
        $this->errorDetail = "User with id {$userId->value()} not registered.";

        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function title(): string
    {
        return 'User not registered.';
    }

    /**
     * @inheritdoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
