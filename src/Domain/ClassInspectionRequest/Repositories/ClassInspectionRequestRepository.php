<?php

namespace ProfessorGradingApp\Domain\ClassInspectionRequest\Repositories;

use ProfessorGradingApp\Domain\ClassInspectionRequest\ClassInspectionRequest;
use ProfessorGradingApp\Domain\ClassInspectionRequest\ValueObjects\ClassInspectionRequestId;
use ProfessorGradingApp\Domain\Common\Criteria\Criteria;

/**
 * Interface ClassInspectionRequestRepository
 *
 * @package ProfessorGradingApp\Domain\ClassInspectionRequest\Repositories
 */
interface ClassInspectionRequestRepository
{
    /**
     * @param ClassInspectionRequest $classInspectionRequest
     * @return void
     */
    public function save(ClassInspectionRequest $classInspectionRequest): void;

    /**
     * @param ClassInspectionRequestId $id
     * @return ClassInspectionRequest|null
     */
    public function find(ClassInspectionRequestId $id): ?ClassInspectionRequest;

    /**
     * @param Criteria $criteria
     * @return ClassInspectionRequest[]
     */
    public function search(Criteria $criteria): array;
}
