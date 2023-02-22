<?php

namespace ProfessorGradingApp\Infrastructure\Grade\Repositories;

use Doctrine\ODM\MongoDB\{LockException, MongoDBException};
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use ProfessorGradingApp\Domain\Grade\Grade;
use ProfessorGradingApp\Domain\Grade\Repositories\GradeRepository;
use ProfessorGradingApp\Domain\Grade\ValueObjects\GradeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories\DoctrineRepository;

/**
 * Class MongoDbGradeRepository
 *
 * @package ProfessorGradingApp\Infrastructure\Grade\Repositories
 */
final class MongoDbGradeRepository extends DoctrineRepository implements GradeRepository
{
    /**
     * @param Grade $Grade
     * @return void
     * @throws MongoDBException
     */
    public function save(Grade $Grade): void
    {
        $this->persist($Grade);
    }

    /**
     * @param GradeId $id
     * @return Grade|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(GradeId $id): ?Grade
    {
        return $this->repository(Grade::class)->find($id);
    }
}
