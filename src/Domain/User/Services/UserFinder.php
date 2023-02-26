<?php

namespace ProfessorGradingApp\Domain\User\Services;

use ProfessorGradingApp\Domain\Common\ValueObjects\User\UserId;
use ProfessorGradingApp\Domain\User\Repositories\UserRepository;
use ProfessorGradingApp\Domain\User\User;

/**
 * Class UserFinder
 *
 * @package ProfessorGradingApp\Domain\User\Services
 */
final class UserFinder
{
    /**
     * @param UserRepository $repository
     */
    public function __construct(private readonly UserRepository $repository)
    {
    }

    /**
     * @param UserId $userId
     * @return User|null
     */
    public function __invoke(UserId $userId): ?User
    {
        return $this->repository->find($userId);
    }
}
