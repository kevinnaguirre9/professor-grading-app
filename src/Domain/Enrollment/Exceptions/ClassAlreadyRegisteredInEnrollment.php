<?php

namespace ProfessorGradingApp\Domain\Enrollment\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;
use ProfessorGradingApp\Domain\Enrollment\ValueObjects\ClassId;

/**
 * Class ClassAlreadyRegisteredInEnrollment
 *
 * @package ProfessorGradingApp\Domain\Enrollment\Exceptions
 */
final class ClassAlreadyRegisteredInEnrollment extends AbstractCoreException
{
    protected const ERROR_TYPE = 'class_already_registered_in_enrollment';

    private string $errorDetail;

    /**
     * @param ClassId $classId
     */
    public function __construct(ClassId $classId)
    {
        $this->errorDetail = "Enrollment already have class <$classId> registered.";

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return "Class already registered in the enrollment.";
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
