<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Subject;

use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Subject\ValueObjects\{DegreeLevel};
use ProfessorGradingApp\Domain\Common\ValueObjects\Degree\DegreeId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Subject\SubjectId;

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
        private iterable $degreesLevel,
        private readonly \DateTimeImmutable $registeredAt,
    ) {
    }

    /**
     * @param SubjectId $id
     * @param string $code
     * @param string $name
     * @param DegreeLevel[] $degreesLevel
     * @return self
     */
    public static function create(
        SubjectId $id,
        string $code,
        string $name,
        iterable $degreesLevel = [],
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
     * @return iterable
     */
    public function degreesLevel(): iterable
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

    /**
     * @return array
     */
    public function toPrimitives(): array
    {
        return [
            'id'   => (string) $this->id(),
            'code' => $this->code(),
            'name' => $this->name(),
//            'degrees_level' => array_map(
//                fn(DegreeLevel $degreeLevel) => $degreeLevel->toPrimitives(), (array) $this->degreesLevel()
//            ),
            'registered_at' => $this->registeredAt()->format('Y-m-d H:i:s'),
        ];
    }
}
