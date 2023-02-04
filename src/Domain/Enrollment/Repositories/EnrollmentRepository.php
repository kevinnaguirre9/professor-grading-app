<?php

namespace ProfessorGradingApp\Domain\Enrollment\Repositories;

use ProfessorGradingApp\Domain\Enrollment\Enrollment;
use ProfessorGradingApp\Domain\Enrollment\ValueObjects\EnrollmentId;

/**
 * Interface EnrollmentRepository
 *
 * @package ProfessorGradingApp\Domain\Enrollment\Repositories
 */
interface EnrollmentRepository
{
    /**
     * @param Enrollment $enrollment
     * @return void
     */
    public function save(Enrollment $enrollment): void;

    /**
     * @param EnrollmentId $id
     * @return Enrollment|null
     */
    public function find(EnrollmentId $id): ?Enrollment;

}
