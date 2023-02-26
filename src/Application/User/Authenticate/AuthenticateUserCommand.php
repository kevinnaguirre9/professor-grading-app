<?php

namespace ProfessorGradingApp\Application\User\Authenticate;

use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command;

/**
 * Class AuthenticateUserCommand
 *
 * @package ProfessorGradingApp\Application\User\Authenticate
 */
final class AuthenticateUserCommand implements Command
{
    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(
        private readonly string $email,
        private readonly string $password
    ) {
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }
}
