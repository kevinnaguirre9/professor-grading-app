<?php

namespace ProfessorGradingApp\Domain\CourseClass\Repositories;

use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;
use ProfessorGradingApp\Domain\CourseClass\CourseClass;

/**
 * Interface ClassRepository
 *
 * @package ProfessorGradingApp\Domain\CourseClass\Repositories
 */
interface ClassRepository
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
