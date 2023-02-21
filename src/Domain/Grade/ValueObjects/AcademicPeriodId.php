<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Grade\ValueObjects;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\Uuid;

/**
 * Class AcademicPeriodId
 *
 * @package ProfessorGradingApp\Domain\Grade\ValueObjects
 */
final class AcademicPeriodId extends Uuid
{
    /**
     * @param string $value
     * @throws InvalidUuid
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
    }
}