<?php

namespace ProfessorGradingApp\Domain\ClassInspectionRequest\Exceptions;

use ProfessorGradingApp\Domain\ClassInspectionRequest\ValueObjects\ClassInspectionRequestStatus;
use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;

/**
 * Class ClassInspectionRequestAlreadyInspected
 *
 * @package ProfessorGradingApp\Domain\ClassInspectionRequest\Exceptions
 */
final class ClassInspectionRequestAlreadyInspected extends AbstractCoreException
{
    protected const ERROR_TYPE = 'class_inspection_request_already_inspected';

    private string $errorDetail;

    /**
     * @param ClassInspectionRequestStatus $attemptedStatus
     */
    public function __construct(ClassInspectionRequestStatus $attemptedStatus)
    {
        $this->errorDetail =  sprintf(
            'Cannot update class inspection status to <%s> because it is already inspected.',
            $attemptedStatus->value()
        );

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Class inspection request already inspected.';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
