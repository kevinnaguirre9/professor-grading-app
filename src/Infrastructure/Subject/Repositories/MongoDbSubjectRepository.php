<?php

namespace ProfessorGradingApp\Infrastructure\Subject\Repositories;

use Doctrine\ODM\MongoDB\{LockException, MongoDBException};
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use ProfessorGradingApp\Domain\Subject\Repositories\SubjectRepository;
use ProfessorGradingApp\Domain\Subject\Subject;
use ProfessorGradingApp\Domain\Subject\ValueObjects\SubjectId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories\DoctrineRepository;

/**
 * Class MongoDbSubjectRepository
 *
 * @package ProfessorGradingApp\Infrastructure\Subject\Repositories
 */
final class MongoDbSubjectRepository extends DoctrineRepository implements SubjectRepository
{
    /**
     * @param Subject $subject
     * @return void
     * @throws MongoDBException
     */
    public function save(Subject $subject): void
    {
        $this->persist($subject);
    }

    /**
     * @param SubjectId $subjectId
     * @return Subject|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(SubjectId $subjectId): ?Subject
    {
        return $this->repository(Subject::class)->find($subjectId);
    }

    /**
     * @param string $code
     * @return Subject|null
     */
    public function findByCode(string $code): ?Subject
    {
        return $this->repository(Subject::class)
            ->findOneBy(['code' => $code]);
    }
}
