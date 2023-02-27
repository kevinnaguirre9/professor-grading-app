<?php

namespace ProfessorGradingApp\Infrastructure\Tutorship\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
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
     * @return iterable
     */
    public function search(Criteria $criteria): iterable
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria);

        //Just getting all the records that match the criteria without pagination
        $doctrineCriteria->setFirstResult(null);
        $doctrineCriteria->setMaxResults(null);

        $totalTutorships = $this->repository(Tutorship::class)
            ->matching($doctrineCriteria)
            ->count();

        //Now we paginate the results
        $doctrineCriteria->setFirstResult($criteria->offset());
        $doctrineCriteria->setMaxResults($criteria->limit());

        $page = ($criteria->offset() / $criteria->limit()) + 1;

        $tutorships =  $this->repository(Tutorship::class)
            ->matching($doctrineCriteria)
            ->toArray();

        return new LengthAwarePaginator(
            $tutorships,
            $totalTutorships,
            $criteria->limit(),
            $page
        );
    }
}
