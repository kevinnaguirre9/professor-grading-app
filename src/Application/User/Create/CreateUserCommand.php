<?php

namespace ProfessorGradingApp\Application\User\Create;

/**
 * Class CreateUserCommand
 *
 * @package ProfessorGradingApp\Application\User\Create
 */
final class CreateUserCommand
{
    /**
     * @param string $email
     * @param string $password
     * @param string $role
     */
    public function __construct(
        private string $email,
        private string $password,
        private string $role,
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
