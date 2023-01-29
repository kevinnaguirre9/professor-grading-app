<?php

namespace ProfessorGradingApp\Domain\Student\Repositories;

use ProfessorGradingApp\Domain\Student\Student;
use ProfessorGradingApp\Domain\Student\ValueObjects\StudentId;

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
}
