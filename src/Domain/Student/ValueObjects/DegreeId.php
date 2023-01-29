<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Student\ValueObjects;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\Uuid;

/**
 * Class DegreeId
 *
 * @package ProfessorGradingApp\Domain\Student\ValueObjects
 */
final class DegreeId extends Uuid
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
