<?php

namespace ProfessorGradingApp\Domain\ClassInspectionRequest\Exceptions;

use ProfessorGradingApp\Domain\ClassInspectionRequest\ValueObjects\ClassInspectionRequestStatus;
use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;

/**
 * Class InvalidClassInspectionRequestStatus
 *
 * @package ProfessorGradingApp\Domain\ClassInspectionRequest\Exceptions
 */
final class InvalidClassInspectionRequestStatus extends AbstractCoreException
{
    protected const ERROR_TYPE = 'invalid_class_inspection_request_status';

    private string $errorDetail;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->errorDetail = sprintf(
            "Class Inspection Request Status value <%s> is not valid. Available values are: %s.",
            $value,
            implode(', ', ClassInspectionRequestStatus::allValues())
        );

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Invalid Class Inspection Request Status.';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
