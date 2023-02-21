<?php

namespace ProfessorGradingApp\Domain\Student\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;
use ProfessorGradingApp\Domain\Student\ValueObjects\NationalIdentificationNumber;

/**
 * Class StudentNationalIdentificationNumberAlreadyRegistered
 *
 * @package ProfessorGradingApp\Domain\Student\Exceptions
 */
final class StudentNationalIdentificationNumberAlreadyRegistered extends AbstractCoreException
{
    protected const ERROR_TYPE = 'student_national_identification_number_already_registered';

    private string $errorDetail;

    /**
     * @param NationalIdentificationNumber $identificationNumber
     */
    public function __construct(NationalIdentificationNumber $identificationNumber)
    {
        $this->errorDetail = "Student with national identification number <$identificationNumber> already exists.";

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Student national identification number already registered.';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
