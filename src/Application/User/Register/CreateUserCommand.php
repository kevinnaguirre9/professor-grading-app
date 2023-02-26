<?php

namespace ProfessorGradingApp\Application\User\Register;

use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command;

/**
 * Class CreateUserCommand
 *
 * @package ProfessorGradingApp\Application\User\Register
 */
final class CreateUserCommand implements Command
{
    /**
     * @param string $email
     * @param string $password
     * @param string $role
     */
    public function __construct(
        private readonly string $email,
        private readonly string $password,
        private readonly string $role,
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

    /**
     * @return string
     */
    public function role(): string
    {
        return $this->role;
    }
}
