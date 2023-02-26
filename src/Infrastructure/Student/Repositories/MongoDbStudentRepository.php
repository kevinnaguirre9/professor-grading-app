<?php

namespace ProfessorGradingApp\Infrastructure\Student\Repositories;

use Doctrine\ODM\MongoDB\{LockException, MongoDBException};
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;
use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;
use ProfessorGradingApp\Domain\Student\Repositories\StudentRepository;
use ProfessorGradingApp\Domain\Student\Student;
use ProfessorGradingApp\Domain\Student\ValueObjects\{NationalIdentificationNumber};
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories\DoctrineRepository;

/**
 * Class MongoDbStudentRepository
 *
 * @package ProfessorGradingApp\Infrastructure\Student\Repositories
 */
final class MongoDbStudentRepository extends DoctrineRepository implements StudentRepository
{
    /**
     * @param Student $student
     * @return void
     * @throws MongoDBException
     */
    public function save(Student $student): void
    {
        $this->persist($student);
    }

    /**
     * @param StudentId $id
     * @return Student|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(StudentId $id): ?Student
    {
        return $this->repository(Student::class)->find($id);
    }

    /**
     * @param InstitutionalEmail $institutionalEmail
     * @return Student|null
     */
    public function findByInstitutionalEmail(InstitutionalEmail $institutionalEmail): ?Student
    {
        return $this->repository(Student::class)
            ->findOneBy(['institutionalEmail' => $institutionalEmail]);
    }

    /**
     * @param NationalIdentificationNumber $identificationNumber
     * @return Student|null
     */
    public function findByNationalIdentificationNumber(NationalIdentificationNumber $identificationNumber): ?Student
    {
        return $this->repository(Student::class)
            ->findOneBy(['nationalIdentificationNumber' => $identificationNumber]);
    }
}
