<?php

namespace ProfessorGradingApp\Domain\Subject\Repositories;

use ProfessorGradingApp\Domain\Subject\Subject;
use ProfessorGradingApp\Domain\Subject\ValueObjects\SubjectId;

/**
 * Interface SubjectRepository
 *
 * @package ProfessorGradingApp\Domain\Subject\Repositories
 */
interface SubjectRepository
{
    /**
     * @param Subject $subject
     * @return void
     */
    public function save(Subject $subject): void;

    /**
     * @param SubjectId $subjectId
     * @return Subject|null
     */
    public function find(SubjectId $subjectId): ?Subject;

    /**
     * @param string $code
     * @return Subject|null
     */
    public function findByCode(string $code): ?Subject;
}
