<?php

namespace ProfessorGradingApp\Application\User\Register;

use ProfessorGradingApp\Domain\Common\Exceptions\{InvalidEmailFormat, InvalidEmailDomain, InvalidUuid};
use ProfessorGradingApp\Domain\Common\ValueObjects\User\UserId;
use ProfessorGradingApp\Domain\User\Contracts\PasswordHashingManager;
use ProfessorGradingApp\Domain\User\Exceptions\UserWithGivenEmailAlreadyRegistered;
use ProfessorGradingApp\Domain\User\Repositories\UserRepository;
use ProfessorGradingApp\Domain\User\User;
use ProfessorGradingApp\Domain\User\ValueObjects\{AuthenticatableId, Role, UserEmail, UserPassword};

/**
 * Class CreateUserHandler
 *
 * @package ProfessorGradingApp\Application\User\Register
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
     * @return User
     * @throws InvalidEmailFormat
     * @throws UserWithGivenEmailAlreadyRegistered
     * @throws InvalidEmailDomain
     * @throws InvalidUuid
     */
    public function __invoke(CreateUserCommand $command): User
    {
        if($this->repository->findByEmail(new UserEmail($command->email())))
            throw new UserWithGivenEmailAlreadyRegistered($command->email());

        $role = Role::from($command->role());

        $hashedPassword = $this->passwordHashingManager->hash($command->password());

        $User = User::create(
            new UserId(),
            new UserEmail($command->email()),
            new UserPassword($hashedPassword),
            $command->fullName(),
            $role,
            new AuthenticatableId($command->authenticatableId()),
        );

        $this->repository->save($User);

        return $User;
    }
}
