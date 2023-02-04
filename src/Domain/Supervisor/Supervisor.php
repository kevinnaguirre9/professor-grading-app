<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Supervisor;

use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;
use ProfessorGradingApp\Domain\Supervisor\ValueObjects\{SupervisorId, UserId};

/**
 * Class Supervisor
 *
 * @package ProfessorGradingApp\Domain\Supervisor
 */
final class Supervisor extends BaseEntity
{
    /**
     * @param SupervisorId $id
     * @param string $fullName
     * @param InstitutionalEmail $institutionalEmail
     * @param UserId $userId
     * @param \DateTimeImmutable $registeredAt
     */
    public function __construct(
        private readonly SupervisorId $id,
        private string $fullName,
        private readonly InstitutionalEmail $institutionalEmail,
        private readonly UserId $userId,
        private readonly \DateTimeImmutable $registeredAt,
    ) {
    }

    /**
     * @param SupervisorId $id
     * @param string $fullName
     * @param InstitutionalEmail $institutionalEmail
     * @param UserId $userId
     * @param \DateTimeImmutable $registeredAt
     * @return Supervisor
     */
    public static function create(
        SupervisorId $id,
        string $fullName,
        InstitutionalEmail $institutionalEmail,
        UserId $userId,
        \DateTimeImmutable $registeredAt = new \DateTimeImmutable()
    ) : Supervisor {
        return new self(
            $id,
            $fullName,
            $institutionalEmail,
            $userId,
            $registeredAt
        );
    }

    /**
     * @return SupervisorId
     */
    public function id(): SupervisorId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return InstitutionalEmail
     */
    public function institutionalEmail(): InstitutionalEmail
{
        return $this->institutionalEmail;
    }

    /**
     * @return UserId
     */
    public function userId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function registeredAt(): \DateTimeImmutable
    {
        return $this->registeredAt;
    }

}
