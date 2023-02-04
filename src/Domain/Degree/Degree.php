<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Degree;

use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Degree\ValueObjects\{DegreeId, SubjectId};

/**
 * Class Degree
 *
 * @package ProfessorGradingApp\Domain\Degree
 */
final class Degree extends BaseEntity
{
    /**
     * @param DegreeId $id
     * @param string $name
     * @param SubjectId[] $subjectIds
     * @param \DateTimeImmutable $registeredAt
     */
    public function __construct(
        private readonly DegreeId $id,
        private readonly string $name,
        private array $subjectIds,
        private readonly \DateTimeImmutable $registeredAt,
    ) {
    }

    /**
     * @param DegreeId $id
     * @param string $name
     * @param SubjectId[] $subjectIds
     * @return static
     */
    public static function create(
        DegreeId $id,
        string $name,
        array $subjectIds = [],
    ): self {
        return new self($id, $name, $subjectIds, new \DateTimeImmutable());
    }

    /**
     * @param SubjectId $subjectId
     * @return void
     */
    public function registerSubject(SubjectId $subjectId): void
    {
        $this->subjectIds[] = $subjectId;
    }

    /**
     * @return DegreeId
     */
    public function id(): DegreeId
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
     * @return SubjectId[]
     */
    public function subjectIds(): array
    {
        return $this->subjectIds;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function registeredAt(): \DateTimeImmutable
    {
        return $this->registeredAt;
    }
}
