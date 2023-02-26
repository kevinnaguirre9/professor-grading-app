<?php

namespace ProfessorGradingApp\Infrastructure\Professor\Repositories;

use Doctrine\ODM\MongoDB\{LockException, MongoDBException};
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use ProfessorGradingApp\Domain\Common\ValueObjects\Professor\ProfessorId;
use ProfessorGradingApp\Domain\Professor\Professor;
use ProfessorGradingApp\Domain\Professor\Repositories\ProfessorRepository;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories\DoctrineRepository;

/**
 * Class MongoDbProfessorRepository
 *
 * @package ProfessorGradingApp\Infrastructure\Professor\Repositories
 */
final class MongoDbProfessorRepository extends DoctrineRepository implements ProfessorRepository
{
    /**
     * @param Professor $Professor
     * @return void
     * @throws MongoDBException
     */
    public function save(Professor $Professor): void
    {
        $this->persist($Professor);
    }

    /**
     * @param ProfessorId $id
     * @return Professor|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(ProfessorId $id): ?Professor
    {
        return $this->repository(Professor::class)->find($id);
    }
}
