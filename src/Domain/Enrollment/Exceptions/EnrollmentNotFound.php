<?php

namespace ProfessorGradingApp\Domain\Enrollment\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;
use ProfessorGradingApp\Domain\Enrollment\ValueObjects\EnrollmentId;

/**
 * Class EnrollmentNotFound
 *
 * @package ProfessorGradingApp\Domain\Enrollment\Exceptions
 */
final class EnrollmentNotFound extends AbstractCoreException
{
    protected const ERROR_TYPE = 'enrollment_not_found';

    private string $errorDetail;

    /**
     * @param EnrollmentId $enrollmentId
     */
    public function __construct(EnrollmentId $enrollmentId)
    {
        $this->errorDetail = "Enrollment with id $enrollmentId doesn't match our records.";

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Enrollment not found';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
