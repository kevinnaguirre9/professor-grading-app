<?php

namespace ProfessorGradingApp\Application\Subject\Register;

use ProfessorGradingApp\Domain\Common\ValueObjects\Degree\DegreeId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Subject\SubjectId;
use ProfessorGradingApp\Domain\Subject\Exceptions\SubjectAlreadyRegistered;
use ProfessorGradingApp\Domain\Subject\Repositories\SubjectRepository;
use ProfessorGradingApp\Domain\Subject\Subject;
use ProfessorGradingApp\Domain\Subject\ValueObjects\DegreeLevel;

/**
 * Class RegisterSubjectHandler
 *
 * @package ProfessorGradingApp\Application\Subject\Register
 */
final class RegisterSubjectHandler
{
    /**
     * @param SubjectRepository $repository
     */
    public function __construct(private readonly SubjectRepository $repository)
    {
    }

    /**
     * @param RegisterSubjectCommand $command
     * @return Subject
     * @throws SubjectAlreadyRegistered
     */
    public function __invoke(RegisterSubjectCommand $command): Subject
    {
        if ($Subject = $this->repository->findByCode($command->code()))
            return $Subject;

        $degreesLevel = array_map($this->degreeLevelBuilder(), $command->degreesLevel());

        $Subject = Subject::create(
            new SubjectId(),
            $command->code(),
            $command->name(),
            $degreesLevel
        );

        $this->repository->save($Subject);

        return $Subject;
    }

    /**
     * @param string $code
     * @return void
     * @throws SubjectAlreadyRegistered
     */
    private function ensureSubjectDoesNotExist(string $code): void
    {
        if ($this->repository->findByCode($code))
            throw new SubjectAlreadyRegistered($code);
    }

    /**
     * @return \Closure
     */
    private function degreeLevelBuilder(): \Closure
    {
        return fn($degreeLevel) => new DegreeLevel(
            new DegreeId($degreeLevel['degree_id']),
            $degreeLevel['level']
        );
    }
}
