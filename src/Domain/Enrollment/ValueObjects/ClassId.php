<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Enrollment\ValueObjects;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\Uuid;

/**
 * Class ClassId
 *
 * @package ProfessorGradingApp\Domain\Enrollment\ValueObjects
 */
final class ClassId extends Uuid
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
