<?php

namespace ProfessorGradingApp\Application\User\Create;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidEmail;
use ProfessorGradingApp\Domain\User\Contracts\PasswordHashingManager;
use ProfessorGradingApp\Domain\User\Exceptions\{InvalidPassword, UserAlreadyExists};
use ProfessorGradingApp\Domain\User\Repositories\UserRepository;
use ProfessorGradingApp\Domain\User\User;
use ProfessorGradingApp\Domain\User\ValueObjects\{Role, UserEmail, UserId, UserPassword};

/**
 * Class CreateUserHandler
 *
 * @package ProfessorGradingApp\Application\User\Create
 */
final class CreateUserHandler
{
    /**
     * @param UserRepository $repository
     * @param PasswordHashingManager $passwordHashingManager
     */
    public function __construct(
        private readonly UserRepository         $repository,
        private readonly PasswordHashingManager $passwordHashingManager,
    ) {
    }

    /**
     * @param CreateUserCommand $command
     * @return void
     * @throws UserAlreadyExists
     * @throws InvalidEmail
     * @throws InvalidPassword
     */
    public function __invoke(CreateUserCommand $command): void
    {
        if($this->repository->findByEmail(new UserEmail($command->email())))
            throw new UserAlreadyExists('User already exists');

        $role = Role::from($command->role());

        $hashedPassword = $this->passwordHashingManager->hash($command->password());

        $User = User::create(
            new UserId(),
            new UserEmail($command->email()),
            new UserPassword($hashedPassword),
            $role
        );

        $this->repository->save($User);
    }
}
