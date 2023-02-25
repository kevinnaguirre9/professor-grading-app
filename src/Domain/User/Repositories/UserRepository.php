<?php

namespace ProfessorGradingApp\Domain\User\Repositories;

use ProfessorGradingApp\Domain\Common\ValueObjects\User\UserId;
use ProfessorGradingApp\Domain\User\User;
use ProfessorGradingApp\Domain\User\ValueObjects\UserEmail;

/**
 * Interface UserRepository
 *
 * @package ProfessorGradingApp\Domain\User\Repositories
 */
interface UserRepository
{
    /**
     * @param User $user
     * @return void
     */
    public function save(User $user): void;

    /**
     * @param UserId $id
     * @return User|null
     */
    public function find(UserId $id): ?User;

    /**
     * @param UserEmail $email
     * @return User|null
     */
    public function findByEmail(UserEmail $email): ?User;

}
