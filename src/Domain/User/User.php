<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\User;

use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Common\ValueObjects\User\UserId;
use ProfessorGradingApp\Domain\User\Contracts\PasswordHashingManager;
use ProfessorGradingApp\Domain\User\ValueObjects\{Role, UserEmail, UserPassword};

/**
 * Class User
 *
 * @package ProfessorGradingApp\Domain\User
 */
final class User extends BaseEntity
{
    /**
     * @param UserId $id
     * @param UserEmail $email
     * @param UserPassword $password
     * @param string $fullName
     * @param Role $role
     * @param bool $isActive
     * @param \DateTimeImmutable $registeredAt
     * @param \DateTimeImmutable|null $updatedAt
     */
    public function __construct(
        private readonly UserId $id,
        private UserEmail $email,
        private UserPassword $password,
        private string $fullName,
        private readonly Role $role,
        private bool $isActive,
        private readonly \DateTimeImmutable $registeredAt,
        private ?\DateTimeImmutable $updatedAt = null,
    ) {
    }

    /**
     * @param UserId $id
     * @param UserEmail $email
     * @param UserPassword $password
     * @param string $fullName
     * @param Role $role
     * @param bool $isActive
     * @param \DateTimeImmutable $registeredAt
     * @return static
     */
    public static function create(
        UserId $id,
        UserEmail $email,
        UserPassword $password,
        string $fullName,
        Role $role,
        bool $isActive = true,
        \DateTimeImmutable $registeredAt = new \DateTimeImmutable(),
    ): self {
        return new self(
            $id,
            $email,
            $password,
            $fullName,
            $role,
            $isActive,
            $registeredAt,
        );
    }

    /**
     * @param PasswordHashingManager $passwordManager
     * @param string $newPassword
     * @return void
     */
    public function updatePassword(
        PasswordHashingManager $passwordManager,
        string $newPassword
    ): void {
        $this->password = new UserPassword(
            $passwordManager->hash($newPassword)
        );

        $this->touch();
    }

    /**
     * @return void
     */
    private function touch(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    /**
     * @return void
     */
    public function deactivate(): void
    {
        $this->isActive = false;

        $this->touch();
    }

    /**
     * @return void
     */
    public function activate(): void
    {
        $this->isActive = true;

        $this->touch();
    }

    /**
     * @return bool
     */
    public function isSupervisor(): bool
    {
        return $this->role->isSupervisor();
    }

    /**
     * @return bool
     */
    public function isStudent(): bool
    {
        return $this->role->isStudent();
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function lastUpdatedDate(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @return UserId
     */
    public function id(): UserId
    {
        return $this->id;
    }

    /**
     * @return UserEmail
     */
    public function email(): UserEmail
    {
        return $this->email;
    }

    /**
     * @return UserPassword
     */
    public function password(): UserPassword
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return Role
     */
    public function role(): Role
    {
        return $this->role;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function registeredAt(): \DateTimeImmutable
    {
        return $this->registeredAt;
    }
}
