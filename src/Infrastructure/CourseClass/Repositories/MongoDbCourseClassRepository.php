<?php

namespace ProfessorGradingApp\Infrastructure\CourseClass\Repositories;

use Doctrine\ODM\MongoDB\{LockException, MongoDBException};
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;
use ProfessorGradingApp\Domain\CourseClass\CourseClass;
use ProfessorGradingApp\Domain\CourseClass\Repositories\CourseClassRepository;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories\DoctrineRepository;

/**
 * Class MongoDbCourseClassRepository
 *
 * @package ProfessorGradingApp\Infrastructure\CourseClass\Repositories
 */
final class MongoDbCourseClassRepository extends DoctrineRepository implements CourseClassRepository
{
    /**
     * @param CourseClass $CourseClass
     * @return void
     * @throws MongoDBException
     */
    public function save(CourseClass $CourseClass): void
    {
        $this->persist($CourseClass);
    }

    /**
     * @param ClassId $id
     * @return CourseClass|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(ClassId $id): ?CourseClass
    {
        return $this->repository(CourseClass::class)->find($id);
    }
}
