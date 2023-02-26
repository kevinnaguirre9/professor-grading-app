<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\User\Contracts;

use ProfessorGradingApp\Domain\User\User;

/**
 * Interface JwtTokenManager
 *
 * @package ProfessorGradingApp\Domain\User\Contracts
 */
interface JwtTokenManager
{
    /**
     * Generates a JWT token for the given user.
     *
     * @param User $User
     * @return string
     */
    public function generate(User $User): string;

    /**
     * Decodes the given JWT token.
     *
     * @param string $token
     * @return array
     */
    public function decode(string $token): array;

}
