<?php

namespace ProfessorGradingApp\Domain\CourseClass\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;
use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;

/**
 * Class ClassNotInProgress
 *
 * @package ProfessorGradingApp\Domain\CourseClass\Exceptions
 */
final class ClassNotInProgress extends AbstractCoreException
{
    protected const ERROR_TYPE = 'class_not_in_progress';

    private string $errorDetail;

    /**
     * @param ClassId $classId
     */
    public function __construct(ClassId $classId)
    {
        $this->errorDetail = "Class {$classId->value()} is not in progress.";

        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function title(): string
    {
        return 'Class is not in progress.';
    }

    /**
     * @inheritdoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
