<?php

namespace ProfessorGradingApp\Domain\Subject\Exceptions;


use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;
use ProfessorGradingApp\Domain\Common\ValueObjects\Subject\SubjectId;

/**
 * Class SubjectNotFountException
 *
 * @package ProfessorGradingApp\Domain\Subject\Exceptions
 */
final class SubjectNotFountException extends AbstractCoreException
{
    protected const ERROR_TYPE = 'subject_not_found';

    /**
     * @var string
     */
    private string $errorDetail;

    /**
     * @param SubjectId $subjectId
     */
    public function __construct(SubjectId $subjectId)
    {
        $this->errorDetail = "Subject with id <$subjectId> hasn't been found.";

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Cannot find subject.';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
