<?php

namespace ProfessorGradingApp\Domain\ClassInspectionRequest\Exceptions;

use ProfessorGradingApp\Domain\ClassInspectionRequest\ValueObjects\ClassInspectionRequestStatus;
use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;

/**
 * Class ClassInspectionRequestNotApproved
 *
 * @package ProfessorGradingApp\Domain\ClassInspectionRequest\Exceptions
 */
final class ClassInspectionRequestNotApproved extends AbstractCoreException
{
    protected const ERROR_TYPE = 'class_inspection_request_not_approved';

    private string $errorDetail;

    public function __construct(ClassInspectionRequestStatus $status)
    {
        $this->errorDetail = sprintf('Current Class inspection request status is %s.', $status->value());

        parent::__construct();
    }
    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Class inspection request has not been approved.';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
