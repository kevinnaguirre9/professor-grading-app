<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Degree\ValueObjects;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\Uuid;

/**
 * Class SubjectId
 *
 * @package ProfessorGradingApp\Domain\Degree\ValueObjects
 */
final class SubjectId extends Uuid
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
