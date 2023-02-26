<?php

namespace ProfessorGradingApp\Infrastructure\User\Repositories;

use Doctrine\ODM\MongoDB\{LockException, MongoDBException};
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use ProfessorGradingApp\Domain\Common\ValueObjects\User\UserId;
use ProfessorGradingApp\Domain\User\Repositories\UserRepository;
use ProfessorGradingApp\Domain\User\User;
use ProfessorGradingApp\Domain\User\ValueObjects\{UserEmail};
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories\DoctrineRepository;

/**
 * Class MongoDbUserRepository
 *
 * @package ProfessorGradingApp\Infrastructure\User\Repositories
 */
final class MongoDbUserRepository extends DoctrineRepository implements UserRepository
{
    /**
     * @param User $user
     * @return void
     * @throws MongoDBException
     */
    public function save(User $user): void
    {
        $this->persist($user);
    }

    /**
     * @param UserId $id
     * @return User|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(UserId $id): ?User
    {
        return $this->repository(User::class)->find($id);
    }

    /**
     * @param UserEmail $email
     * @return User|null
     */
    public function findByEmail(UserEmail $email): ?User
    {
       return $this->repository(User::class)->findOneBy(['email' => $email]);
    }

}
