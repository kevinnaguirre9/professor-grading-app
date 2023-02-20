<?php

namespace ProfessorGradingApp\Domain\User\ValueObjects;

use ProfessorGradingApp\Domain\Common\ValueObjects\Email;

/**
 * Class UserEmail
 *
 * @package ProfessorGradingApp\Domain\User\ValueObjects
 */
final class UserEmail extends Email
{
    /**
     * The allowed email domains
     *
     * @var string[]
     */
    protected array $allowedDomains = [
        'ups.edu.ec',
        'est.ups.edu.ec',
    ];
}
