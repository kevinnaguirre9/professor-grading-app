<?php

namespace ProfessorGradingApp\Domain\Student\Services;

use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;
use ProfessorGradingApp\Domain\Student\Exceptions\StudentNotFound;
use ProfessorGradingApp\Domain\Student\Repositories\StudentRepository;
use ProfessorGradingApp\Domain\Student\Student;

/**
 * Class StudentFinder
 *
 * @package ProfessorGradingApp\Domain\Student\Services
 */
final class StudentFinder
{
    /**
     * @param StudentRepository $repository
     */
    public function __construct(private readonly StudentRepository $repository)
    {
    }

    /**
     * @param StudentId $studentId
     * @return Student
     * @throws StudentNotFound
     */
    public function __invoke(StudentId $studentId): Student
    {
        $Student = $this->repository->find($studentId);

        if (null === $Student) {
            throw new StudentNotFound($studentId);
        }

        return $Student;
    }
}
