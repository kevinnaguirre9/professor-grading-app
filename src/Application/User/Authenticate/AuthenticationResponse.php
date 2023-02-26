<?php

namespace ProfessorGradingApp\Application\User\Authenticate;

/**
 * Class AuthenticationResponse
 *
 * @package ProfessorGradingApp\Application\User\Authenticate
 */
final class AuthenticationResponse
{
    /**
     * @param string $userId
     * @param string $email
     * @param string $token
     */
    public function __construct(
        private readonly string $userId,
        private readonly string $email,
        private readonly string $token,
    ) {
    }

    /**
     * @return string
     */
    public function userId(): string
    {
        return $this->userId;
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
    public function token(): string
    {
        return $this->token;
    }
}
