<?php

namespace ProfessorGradingApp\Domain\CourseClass\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;
use ProfessorGradingApp\Domain\CourseClass\ValueObjects\ClassId;
use ProfessorGradingApp\Domain\CourseClass\ValueObjects\ProfessorId;

/**
 * Class ProfessorAlreadyAssignedToClass
 *
 * @package ProfessorGradingApp\Domain\CourseClass\Exceptions
 */
final class ProfessorAlreadyAssignedToClass extends AbstractCoreException
{
    protected const ERROR_TYPE = 'professor_already_assigned_to_class';

    private string $errorDetail;

    /**
     * @param ClassId $classId
     * @param ProfessorId $professorId
     */
    public function __construct(ClassId $classId, ProfessorId $professorId)
    {
        $this->errorDetail = sprintf(
            'Professor %s is already assigned to class %s',
            $professorId->value(),
            $classId->value()
        );

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Cannot assign professor to class';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
