<?php

namespace ProfessorGradingApp\Domain\Subject\Services;


use ProfessorGradingApp\Domain\Common\ValueObjects\Subject\SubjectId;
use ProfessorGradingApp\Domain\Subject\Exceptions\SubjectNotFountException;
use ProfessorGradingApp\Domain\Subject\Repositories\SubjectRepository;
use ProfessorGradingApp\Domain\Subject\Subject;

/**
 * Class SubjectFinder
 *
 * @package ProfessorGradingApp\Domain\Subject\Services
 */
final class SubjectFinder
{

    public function __construct(private readonly SubjectRepository $repository)
    {
    }

    /**
     * @throws SubjectNotFountException
     */
    public function __invoke(SubjectId $subjectId): Subject
    {
        $Subject = $this->repository->find($subjectId);

        if($Subject == null)
            throw new SubjectNotFountException($subjectId);

        return $Subject;
    }

}
