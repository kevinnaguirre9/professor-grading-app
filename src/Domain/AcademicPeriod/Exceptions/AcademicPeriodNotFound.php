<?php

namespace ProfessorGradingApp\Domain\AcademicPeriod\Exceptions;

/**
 * Class AcademicPeriodNotFound
 *
 * @package ProfessorGradingApp\Domain\AcademicPeriod\Exceptions
 */
final class AcademicPeriodNotFound extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message = 'Academic period not found')
    {
        parent::__construct($message);
    }

}
