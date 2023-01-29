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
     * @param \DateTimeImmutable $createdAt
     */
    public function __construct(
        private readonly AcademicPeriodId $id,
        private readonly string $name,
        private readonly \DateTimeImmutable $createdAt,
    )
    {
    }

    /**
     * @param AcademicPeriodId $id
     * @param string $name
     * @return static
     */
    public static function create(AcademicPeriodId $id, string $name): self
    {
        return new self($id, $name, new \DateTimeImmutable());
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
}
