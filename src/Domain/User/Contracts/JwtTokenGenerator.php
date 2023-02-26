<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\User\Contracts;

use ProfessorGradingApp\Domain\User\User;

/**
 * Interface JwtTokenGenerator
 *
 * @package ProfessorGradingApp\Domain\User\Contracts
 */
interface JwtTokenGenerator
{
    /**
     * Generates a JWT token for the given user.
     *
     * @param User $User
     * @return string
     */
    public function generate(User $User): string;
}
