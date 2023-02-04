<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\AcademicPeriod;

use ProfessorGradingApp\Domain\AcademicPeriod\ValueObjects\AcademicPeriodId;
use ProfessorGradingApp\Domain\Common\BaseEntity;

/**
 * Class AcademicPeriod
 *
 * @package ProfessorGradingApp\Domain\AcademicPeriod
 */
final class AcademicPeriod extends BaseEntity
{
    /**
     * @param AcademicPeriodId $id
     * @param string $name
     * @param bool $isActive
     * @param \DateTimeImmutable $registeredAt
     */
    public function __construct(
        private readonly AcademicPeriodId $id,
        private string $name,
        public bool $isActive,
        private readonly \DateTimeImmutable $registeredAt,
    ) {
    }

    /**
     * @param AcademicPeriodId $id
     * @param string $name
     * @param bool $isActive
     * @return static
     */
    public static function create(AcademicPeriodId $id, string $name, bool $isActive = true): self
    {
        return new self($id, $name, $isActive, new \DateTimeImmutable());
    }

    /**
     * @return void
     */
    public function deactivate(): void
    {
        $this->isActive = false;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @return AcademicPeriodId
     */
    public function id(): AcademicPeriodId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function registeredAt(): \DateTimeImmutable
    {
        return $this->registeredAt;
    }
}
