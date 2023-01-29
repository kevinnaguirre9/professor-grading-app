<?php

namespace ProfessorGradingApp\Domain\Student\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;
use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;

/**
 * Class StudentInstitutionalEmailAlreadyRegistered
 *
 * @package ProfessorGradingApp\Domain\Student\Exceptions
 */
final class StudentInstitutionalEmailAlreadyRegistered extends AbstractCoreException
{
    protected const ERROR_TYPE = 'student_institutional_email_already_registered';

    private string $errorDetail;

    /**
     * @param InstitutionalEmail $institutionalEmail
     */
    public function __construct(InstitutionalEmail $institutionalEmail)
    {
        $this->errorDetail = "The student institutional email {$institutionalEmail} is already in use.";

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Cannot register student';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
