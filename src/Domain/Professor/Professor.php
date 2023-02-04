<?php

namespace ProfessorGradingApp\Domain\Professor;

use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Professor\ValueObjects\{ClassId, DegreeId, ProfessorId};

/**
 * Class Professor
 *
 * @package ProfessorGradingApp\Domain\Professor
 */
final class Professor extends BaseEntity
{
    /**
     * @param ProfessorId $id
     * @param string $fullName
     * @param ClassId[] $classIds
     * @param DegreeId[] $degreeIds
     * @param \DateTimeImmutable $registeredAt
     */
    public function __construct(
        private readonly ProfessorId $id,
        private string $fullName,
        private array $classIds,
        private array $degreeIds,
        private readonly \DateTimeImmutable $registeredAt,
    ) {
    }

    /**
     * @param ProfessorId $id
     * @param string $fullName
     * @param ClassId[] $classIds
     * @param DegreeId[] $degreeIds
     * @param \DateTimeImmutable $registeredAt
     * @return Professor
     */
    public static function create(
        ProfessorId $id,
        string $fullName,
        array $classIds = [],
        array $degreeIds = [],
        \DateTimeImmutable $registeredAt = new \DateTimeImmutable(),
    ): Professor {
        return new Professor($id, $fullName, $classIds, $degreeIds, $registeredAt);
    }

    /**
     * @param ClassId $classId
     * @return void
     */
    public function assignClass(ClassId $classId): void
    {
        $this->classIds[] = $classId;
    }

    /**
     * @param DegreeId $degreeId
     * @return void
     */
    public function assignDegree(DegreeId $degreeId): void
    {
        $this->degreeIds[] = $degreeId;
    }

    /**
     * @return ProfessorId
     */
    public function id(): ProfessorId
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
     * @return ClassId[]
     */
    public function classIds(): array
    {
        return $this->classIds;
    }

    /**
     * @return DegreeId[]
     */
    public function degreeIds(): array
    {
        return $this->degreeIds;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function registeredAt(): \DateTimeImmutable
    {
        return $this->registeredAt;
    }
}
