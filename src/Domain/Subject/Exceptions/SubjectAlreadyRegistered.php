<?php

namespace ProfessorGradingApp\Domain\Subject\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;

/**
 * Class SubjectAlreadyRegistered
 *
 * @package ProfessorGradingApp\Domain\Subject\Exceptions
 */
final class SubjectAlreadyRegistered extends AbstractCoreException
{
    protected const ERROR_TYPE = 'subject_already_registered';

    /**
     * @var string
     */
    private string $errorDetail;

    /**
     * @param string $subjectCode
     */
    public function __construct(string $subjectCode)
    {
        $this->errorDetail = "Subject with code <$subjectCode> already registered.";

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Cannot register subject.';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
