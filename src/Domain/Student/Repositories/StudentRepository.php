<?php

namespace ProfessorGradingApp\Domain\Student\Repositories;

use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;
use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;
use ProfessorGradingApp\Domain\Student\Student;
use ProfessorGradingApp\Domain\Student\ValueObjects\NationalIdentificationNumber;

/**
 * Interface StudentRepository
 *
 * @package ProfessorGradingApp\Domain\Student\Repositories
 */
interface StudentRepository
{
    /**
     * @param Student $student
     * @return void
     */
    public function save(Student $student): void;

    /**
     * @param StudentId $id
     * @return Student|null
     */
    public function find(StudentId $id): ?Student;

    /**
     * @param InstitutionalEmail $institutionalEmail
     * @return Student|null
     */
    public function findByInstitutionalEmail(InstitutionalEmail $institutionalEmail): ?Student;

    /**
     * @param NationalIdentificationNumber $identificationNumber
     * @return Student|null
     */
    public function findByNationalIdentificationNumber(NationalIdentificationNumber $identificationNumber): ?Student;

}
