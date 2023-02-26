<?php

namespace ProfessorGradingApp\Application\Student\Update;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;
use ProfessorGradingApp\Domain\Common\ValueObjects\User\UserId;
use ProfessorGradingApp\Domain\Student\Repositories\StudentRepository;

/**
 * Class UpdateStudentHandler
 *
 * @package ProfessorGradingApp\Application\Student\Update
 */
final class UpdateStudentHandler
{
    /**
     * @param StudentRepository $repository
     */
    public function __construct(private readonly StudentRepository $repository)
    {
    }

    /**
     * @param UpdateStudentCommand $command
     * @return void
     * @throws InvalidUuid
     */
    public function __invoke(UpdateStudentCommand $command): void
    {
        $Student = $this->repository->find(
            new StudentId($command->studentId())
        );

        $Student->updateUserId(
            new UserId($command->userId())
        );

        $this->repository->save($Student);
    }
}
