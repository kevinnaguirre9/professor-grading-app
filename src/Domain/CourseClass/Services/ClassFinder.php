<?php

namespace ProfessorGradingApp\Domain\CourseClass\Services;

use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;
use ProfessorGradingApp\Domain\CourseClass\CourseClass;
use ProfessorGradingApp\Domain\CourseClass\Exceptions\ClassNotFound;
use ProfessorGradingApp\Domain\CourseClass\Repositories\ClassRepository;

/**
 * Class ClassFinder
 *
 * @package ProfessorGradingApp\Domain\CourseClass\Services
 */
final class ClassFinder
{
    /**
     * @param ClassRepository $repository
     */
    public function __construct(private readonly ClassRepository $repository)
    {
    }

    /**
     * @param ClassId $classId
     * @return CourseClass|null
     * @throws ClassNotFound
     */
    public function __invoke(ClassId $classId): ?CourseClass
    {
        $Class = $this->repository->find($classId);

        if(! $Class)
            throw new ClassNotFound($classId);

        return $Class;
    }
}
