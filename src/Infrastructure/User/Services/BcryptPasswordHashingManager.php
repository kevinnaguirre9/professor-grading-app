<?php

namespace ProfessorGradingApp\Infrastructure\User\Services;

use Illuminate\Hashing\BcryptHasher;
use Illuminate\Hashing\HashManager;
use ProfessorGradingApp\Domain\User\Contracts\PasswordHashingManager;

/**
 * Class BcryptPasswordHashingManager
 *
 * @package ProfessorGradingApp\Infrastructure\User\Services
 */
final class BcryptPasswordHashingManager implements PasswordHashingManager
{
    /**
     * @var BcryptHasher
     */
    private BcryptHasher $hasher;

    /**
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->hasher = new BcryptHasher($options);
    }

    /**
     * @inheritDoc
     */
    public function hash(string $password): string
    {
        return $this->hasher->make($password);
    }

    /**
     * @inheritDoc
     */
    public function verify(string $password, string $hash): bool
    {
        return $this->hasher->check($password, $hash);
    }
}
