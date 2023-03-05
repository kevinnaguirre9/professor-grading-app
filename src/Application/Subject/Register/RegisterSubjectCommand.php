<?php

namespace ProfessorGradingApp\Application\Subject\Register;

/**
 * Class RegisterSubjectCommand
 *
 * @package ProfessorGradingApp\Application\Subject\Register
 */
final class RegisterSubjectCommand
{
    /**
     * @param string $code
     * @param string $name
     * @param array $degreesLevel
     */
    public function __construct(
        private readonly string $code,
        private readonly string $name,
        private readonly array $degreesLevel = [],
    ) {
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function degreesLevel(): array
    {
        return $this->degreesLevel;
    }
}
