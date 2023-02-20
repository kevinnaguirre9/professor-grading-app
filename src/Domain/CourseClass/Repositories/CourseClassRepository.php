<?php

namespace ProfessorGradingApp\Domain\CourseClass\Repositories;

use ProfessorGradingApp\Domain\CourseClass\CourseClass;
use ProfessorGradingApp\Domain\CourseClass\ValueObjects\ClassId;

/**
 * Interface CourseClassRepository
 *
 * @package ProfessorGradingApp\Domain\CourseClass\Repositories
 */
interface CourseClassRepository
{
    /**
     * @param CourseClass $CourseClass
     * @return void
     */
    public function save(CourseClass $CourseClass): void;

    /**
     * @param ClassId $id
     * @return CourseClass|null
     */
    public function find(ClassId $id): ?CourseClass;
}
