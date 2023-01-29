<?php

namespace ProfessorGradingApp\Application\Supervisor\Register;

/**
 * Class RegisterSupervisorCommand
 *
 * @package ProfessorGradingApp\Application\Supervisor\Register
 */
final class RegisterSupervisorCommand
{
    /**
     * @param string $fullName
     * @param string $institutionalEmail
     * @param string $userId
     */
    public function __construct(
        private readonly string $fullName,
        private readonly string $institutionalEmail,
        private readonly string $userId,
    ) {
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function institutionalEmail(): string
    {
        return $this->institutionalEmail;
    }

    /**
     * @return string
     */
    public function userId(): string
    {
        return $this->userId;
    }

}
