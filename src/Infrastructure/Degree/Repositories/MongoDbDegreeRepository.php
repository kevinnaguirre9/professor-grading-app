<?php

namespace ProfessorGradingApp\Infrastructure\Degree\Repositories;

use Doctrine\ODM\MongoDB\{LockException, MongoDBException};
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use ProfessorGradingApp\Domain\Degree\Degree;
use ProfessorGradingApp\Domain\Degree\Repositories\DegreeRepository;
use ProfessorGradingApp\Domain\Degree\ValueObjects\DegreeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories\DoctrineRepository;

/**
 * Class MongoDbDegreeRepository
 *
 * @package ProfessorGradingApp\Infrastructure\Degree\Repositories
 */
final class MongoDbDegreeRepository extends DoctrineRepository implements DegreeRepository
{
    /**
     * @param Degree $Degree
     * @return void
     * @throws MongoDBException
     */
    public function save(Degree $Degree): void
    {
        $this->persist($Degree);
    }

    /**
     * @param DegreeId $id
     * @return Degree|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(DegreeId $id): ?Degree
    {
        return $this->repository(Degree::class)->find($id);
    }
}
