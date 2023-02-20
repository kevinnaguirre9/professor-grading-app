<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Subject\ValueObjects;

/**
 * Class DegreeLevel
 *
 * @package ProfessorGradingApp\Domain\Subject\ValueObjects
 */
final class DegreeLevel
{
    /**
     * @param DegreeId $degreeId
     * @param int $level
     */
    public function __construct(
        private readonly DegreeId $degreeId,
        private readonly int      $level,
    ) {
    }

    /**
     * @return DegreeId
     */
    public function degreeId(): DegreeId
    {
        return $this->degreeId;
    }

    /**
     * @return int
     */
    public function level(): int
    {
        return $this->level;
    }
}
