<?php

namespace ProfessorGradingApp\Infrastructure\ClassInspectionRequest\Repositories;

use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use Doctrine\ODM\MongoDB\MongoDBException;
use ProfessorGradingApp\Domain\ClassInspectionRequest\ClassInspectionRequest;
use ProfessorGradingApp\Domain\ClassInspectionRequest\Repositories\ClassInspectionRequestRepository;
use ProfessorGradingApp\Domain\ClassInspectionRequest\ValueObjects\ClassInspectionRequestId;
use ProfessorGradingApp\Domain\Common\Criteria\Criteria;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Criteria\DoctrineCriteriaConverter;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories\DoctrineRepository;

/**
 * Class MongoDbClassInspectionRequestRepository
 *
 * @package ProfessorGradingApp\Infrastructure\ClassInspectionRequest\Repositories
 */
final class MongoDbClassInspectionRequestRepository extends DoctrineRepository implements ClassInspectionRequestRepository
{
    /**
     * @param ClassInspectionRequest $classInspectionRequest
     * @return void
     * @throws MongoDBException
     */
    public function save(ClassInspectionRequest $classInspectionRequest): void
    {
        $this->persist($classInspectionRequest);
    }

    /**
     * @param ClassInspectionRequestId $id
     * @return ClassInspectionRequest|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(ClassInspectionRequestId $id): ?ClassInspectionRequest
    {
        return $this->repository(ClassInspectionRequest::class)->find($id);
    }

    /**
     * @param Criteria $criteria
     * @return array|ClassInspectionRequest[]
     */
    public function search(Criteria $criteria): array
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria);

        return $this->repository(ClassInspectionRequest::class)
            ->matching($doctrineCriteria)
            ->toArray();
    }
}
