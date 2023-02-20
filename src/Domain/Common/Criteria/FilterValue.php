<?php

namespace ProfessorGradingApp\Domain\Common\Criteria;

/**
 * Class FilterValue
 *
 * @package ProfessorGradingApp\Domain\Common\Criteria
 */
final class FilterValue
{
    /**
     * @param mixed $value
     */
    public function __construct(protected mixed $value)
    {
    }

    /**
     * @return mixed
     */
    public function value(): mixed
    {
        return $this->value;
    }
}
