<?php

namespace ProfessorGradingApp\Domain\CourseClass\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;
use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;

/**
 * Class ClassNotFound
 *
 * @package ProfessorGradingApp\Domain\CourseClass\Exceptions
 */
final class ClassNotFound extends AbstractCoreException
{
    protected const ERROR_TYPE = 'class_not_found';

    private string $errorDetail;

    /**
     * @param ClassId $classId
     */
    public function __construct(ClassId $classId)
    {
        $this->errorDetail = "Class with id {$classId->value()} not found.";

        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function title(): string
    {
        return 'Class not found.';
    }

    /**
     * @inheritdoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
