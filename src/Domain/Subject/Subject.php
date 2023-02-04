<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Subject;

use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Subject\ValueObjects\{DegreeId, DegreeLevel, SubjectId};

/**
 * Class Subject
 *
 * @package ProfessorGradingApp\Domain\Subject
 */
final class Subject extends BaseEntity
{
    /**
     * @param SubjectId $id
     * @param string $code
     * @param string $name
     * @param DegreeLevel[] $degreesLevel
     * @param \DateTimeImmutable $registeredAt
     */
    public function __construct(
        private readonly SubjectId $id,
        private readonly string $code,
        private string $name,
        private array $degreesLevel,
        private readonly \DateTimeImmutable $registeredAt,
    ) {
    }

    /**
     * @param SubjectId $id
     * @param string $code
     * @param string $name
     * @param DegreeLevel[] $degreesLevel
     * @return static
     */
    public static function create(
        SubjectId $id,
        string $code,
        string $name,
        array $degreesLevel = [],
    ): self {
        return new self($id, $code, $name, $degreesLevel, new \DateTimeImmutable());
    }

    /**
     * @param DegreeId $degreeId
     * @param int $level
     * @return void
     */
    public function assignToLevelInDegree(DegreeId $degreeId, int $level): void
    {
        $this->degreesLevel[] = new DegreeLevel($degreeId, $level);
    }

    /**
     * @return SubjectId
     */
    public function id(): SubjectId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function degreesLevel(): array
    {
        return $this->degreesLevel;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function registeredAt(): \DateTimeImmutable
    {
        return $this->registeredAt;
    }
}
