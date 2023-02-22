<?php

namespace ProfessorGradingApp\Infrastructure\Tutorship\Repositories;

use Doctrine\ODM\MongoDB\{LockException, MongoDBException};
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use ProfessorGradingApp\Domain\Common\Criteria\Criteria;
use ProfessorGradingApp\Domain\Tutorship\Repositories\TutorshipRepository;
use ProfessorGradingApp\Domain\Tutorship\Tutorship;
use ProfessorGradingApp\Domain\Tutorship\ValueObjects\TutorshipId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Criteria\DoctrineCriteriaConverter;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories\DoctrineRepository;

/**
 * Class MongoDbTutorshipRepository
 *
 * @package ProfessorGradingApp\Infrastructure\Tutorship\Repositories
 */
final class MongoDbTutorshipRepository extends DoctrineRepository implements TutorshipRepository
{
    /**
     * @param Tutorship $tutorship
     * @return void
     * @throws MongoDBException
     */
    public function save(Tutorship $tutorship): void
    {
        $this->persist($tutorship);
    }

    /**
     * @param TutorshipId $id
     * @return Tutorship|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(TutorshipId $id): ?Tutorship
    {
        return $this->repository(Tutorship::class)->find($id);
    }

    /**
     * @param Criteria $criteria
     * @return array|Tutorship[]
     */
    public function search(Criteria $criteria): array
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria);

        return $this->repository(Tutorship::class)
            ->matching($doctrineCriteria)
            ->toArray();
    }
}
