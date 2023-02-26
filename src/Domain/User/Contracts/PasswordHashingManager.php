<?php

declare(strict_types=1);


namespace ProfessorGradingApp\Domain\User\Contracts;

/**
 * Interface PasswordHashingManager
 *
 * @package ProfessorGradingApp\Domain\User\Contracts
 */
interface PasswordHashingManager
{
    /**
     * Hashes the given password.
     *
     * @param string $password
     * @return string
     */
    public function hash(string $password): string;

    /**
     * Checks if the given password matches the given hash.
     *
     * @param string $plainPassword
     * @param string $hash
     * @return bool
     */
    public function verify(string $plainPassword, string $hash): bool;
}
