<?php

namespace ProfessorGradingApp\Infrastructure\AcademicPeriod\Repositories;

use Doctrine\ODM\MongoDB\{MongoDBException, LockException};
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use ProfessorGradingApp\Domain\AcademicPeriod\AcademicPeriod;
use ProfessorGradingApp\Domain\AcademicPeriod\Criteria\AcademicPeriodsCollection;
use ProfessorGradingApp\Domain\AcademicPeriod\Repositories\AcademicPeriodRepository;
use ProfessorGradingApp\Domain\Common\Criteria\Criteria;
use ProfessorGradingApp\Domain\Common\ValueObjects\AcademicPeriod\AcademicPeriodId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Criteria\DoctrineCriteriaConverter;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories\DoctrineRepository;

/**
 * Class MongoDbAcademicPeriodRepository
 *
 * @package ProfessorGradingApp\Infrastructure\AcademicPeriod\Repositories
 */
final class MongoDbAcademicPeriodRepository extends DoctrineRepository implements AcademicPeriodRepository
{
    /**
     * @param AcademicPeriod $academicPeriod
     * @return void
     * @throws MongoDBException
     */
    public function save(AcademicPeriod $academicPeriod): void
    {
        $this->persist($academicPeriod);
    }

    /**
     * @return AcademicPeriod[]
     */
    public function all(): array
    {
        return $this->repository(AcademicPeriod::class)->findAll();
    }

    /**
     * @param AcademicPeriodId $id
     * @return AcademicPeriod|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(AcademicPeriodId $id): ?AcademicPeriod
    {
        return $this->repository(AcademicPeriod::class)->find($id);
    }

    /**
     * @param Criteria $criteria
     * @return AcademicPeriodsCollection
     */
    public function search(Criteria $criteria): AcademicPeriodsCollection
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria);

        $academicPeriods = $this->repository(AcademicPeriod::class)
            ->matching($doctrineCriteria)
            ->toArray();

        return new AcademicPeriodsCollection($academicPeriods);
    }
}
