<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Subject\ValueObjects;

use ProfessorGradingApp\Domain\Common\ValueObjects\Degree\DegreeId;

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

    /**
     * @return array
     */
    public function toPrimitives(): array
    {
        return [
            'degree_id' => (string) $this->degreeId,
            'level' => $this->level,
        ];
    }
}
