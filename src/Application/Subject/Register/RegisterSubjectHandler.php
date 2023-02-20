<?php

namespace ProfessorGradingApp\Application\Subject\Register;

use ProfessorGradingApp\Domain\Subject\Exceptions\SubjectAlreadyRegistered;
use ProfessorGradingApp\Domain\Subject\Repositories\SubjectRepository;
use ProfessorGradingApp\Domain\Subject\Subject;
use ProfessorGradingApp\Domain\Subject\ValueObjects\{DegreeId, DegreeLevel, SubjectId};

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
     * @return void
     * @throws SubjectAlreadyRegistered
     */
    public function __invoke(RegisterSubjectCommand $command) : void
    {
        $this->ensureSubjectDoesNotExist($command->code());

        $degreesLevel = array_map($this->degreeLevelBuilder(), $command->degreesLevel());

        $Subject = Subject::create(
            new SubjectId(),
            $command->code(),
            $command->name(),
            $degreesLevel
        );

        $this->repository->save($Subject);

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
    private function degreeLevelBuilder() : \Closure
    {
        return fn($degreeId, $level) => new DegreeLevel(new DegreeId($degreeId), $level);
    }
}
