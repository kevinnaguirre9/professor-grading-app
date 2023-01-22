<?php

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
     */
    public function __construct(
        private AcademicPeriodId $id,
        private string $name,
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
        return new self($id, $name);
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
