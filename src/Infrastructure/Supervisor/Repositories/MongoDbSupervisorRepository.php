<?php

namespace ProfessorGradingApp\Infrastructure\Supervisor\Repositories;

use Doctrine\ODM\MongoDB\{LockException, MongoDBException};
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;
use ProfessorGradingApp\Domain\Supervisor\Repositories\SupervisorRepository;
use ProfessorGradingApp\Domain\Supervisor\Supervisor;
use ProfessorGradingApp\Domain\Supervisor\ValueObjects\SupervisorId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories\DoctrineRepository;

/**
 * Class MongoDbSupervisorRepository
 *
 * @package ProfessorGradingApp\Infrastructure\Supervisor\Repositories
 */
final class MongoDbSupervisorRepository extends DoctrineRepository implements SupervisorRepository
{
    /**
     * @param Supervisor $Supervisor
     * @return void
     * @throws MongoDBException
     */
    public function save(Supervisor $Supervisor): void
    {
        $this->persist($Supervisor);
    }

    /**
     * @param SupervisorId $id
     * @return Supervisor|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(SupervisorId $id): ?Supervisor
    {
        return $this->repository(Supervisor::class)->find($id);
    }

    /**
     * @param InstitutionalEmail $institutionalEmail
     * @return Supervisor|null
     */
    public function findByInstitutionalEmail(InstitutionalEmail $institutionalEmail): ?Supervisor
    {
        return $this->repository(Supervisor::class)
            ->findOneBy(['institutionalEmail' => $institutionalEmail]);
    }
}
