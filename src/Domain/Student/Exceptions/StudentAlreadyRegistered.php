<?php

namespace ProfessorGradingApp\Domain\Student\Exceptions;

/**
 * Class StudentAlreadyRegistered
 *
 * @package ProfessorGradingApp\Domain\Student\Exceptions
 */
final class StudentAlreadyRegistered extends \Exception
{
    /**
     * @param string $studentId
     *
     * @return StudentAlreadyRegistered
     */
    public static function withStudentId(string $studentId): self
    {
        return new self(sprintf('Student with id %s already registered', $studentId));
    }
}
