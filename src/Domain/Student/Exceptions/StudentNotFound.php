<?php

namespace ProfessorGradingApp\Domain\Student\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;
use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;

/**
 * Class StudentNotFound
 *
 * @package ProfessorGradingApp\Domain\Student\Exceptions
 */
final class StudentNotFound extends AbstractCoreException
{
    protected const ERROR_TYPE = 'student_not_found';

    private string $errorDetail;

    /**
     * @param StudentId|null $studentId
     */
    public function __construct(StudentId $studentId = null)
    {
        $this->errorDetail = $studentId
            ? "Student with id $studentId not found."
            : 'Student not found.';

        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function title(): string
    {
        return 'Student not found.';
    }

    /**
     * @inheritdoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
