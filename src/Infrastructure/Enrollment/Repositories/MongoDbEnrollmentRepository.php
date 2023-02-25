<?php

namespace ProfessorGradingApp\Infrastructure\Enrollment\Repositories;

use Doctrine\ODM\MongoDB\{LockException, MongoDBException};
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use ProfessorGradingApp\Domain\Common\ValueObjects\Enrollment\EnrollmentId;
use ProfessorGradingApp\Domain\Enrollment\Enrollment;
use ProfessorGradingApp\Domain\Enrollment\Repositories\EnrollmentRepository;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories\DoctrineRepository;

/**
 * Class MongoDbEnrollmentRepository
 *
 * @package ProfessorGradingApp\Infrastructure\Enrollment\Repositories
 */
final class MongoDbEnrollmentRepository extends DoctrineRepository implements EnrollmentRepository
{
    /**
     * @param Enrollment $enrollment
     * @return void
     * @throws MongoDBException
     */
    public function save(Enrollment $enrollment): void
    {
        $this->persist($enrollment);
    }

    /**
     * @param EnrollmentId $id
     * @return Enrollment|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(EnrollmentId $id): ?Enrollment
    {
        return $this->repository(Enrollment::class)->find($id);
    }
}
