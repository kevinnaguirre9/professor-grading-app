<?php

namespace ProfessorGradingApp\Application\User\Authenticate;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidEmailDomain;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidEmailFormat;
use ProfessorGradingApp\Domain\User\Contracts\JwtTokenGenerator;
use ProfessorGradingApp\Domain\User\Contracts\PasswordHashingManager;
use ProfessorGradingApp\Domain\User\Exceptions\InvalidCredentials;
use ProfessorGradingApp\Domain\User\Repositories\UserRepository;
use ProfessorGradingApp\Domain\User\ValueObjects\UserEmail;

/**
 * Class AuthenticateUserHandler
 *
 * @package ProfessorGradingApp\Application\User\Authenticate
 */
final class AuthenticateUserHandler
{
    public function __construct(
        private readonly UserRepository $repository,
        private readonly PasswordHashingManager $hashingManager,
        private readonly JwtTokenGenerator $tokenGenerator,
    ) {
    }

    /**
     * @param AuthenticateUserCommand $command
     * @return AuthenticationResponse
     * @throws InvalidCredentials
     * @throws InvalidEmailDomain
     * @throws InvalidEmailFormat
     */
    public function __invoke(AuthenticateUserCommand $command): AuthenticationResponse
    {
        $userEmail = new UserEmail($command->email());

        $User = $this->repository->findByEmail($userEmail);

        if (null === $User)
            throw new InvalidCredentials;

        if (! $this->hashingManager->verify($command->password(), $User->password()))
            throw new InvalidCredentials;

        $token = $this->tokenGenerator->generate($User);

        return new AuthenticationResponse(
            $User->id(),
            $User->email(),
            $token
        );
    }
}
