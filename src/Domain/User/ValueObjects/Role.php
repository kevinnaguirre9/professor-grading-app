<?php

namespace ProfessorGradingApp\Domain\User\ValueObjects;

/**
 * Enum Role
 *
 * @package ProfessorGradingApp\Domain\User\ValueObjects
 */
enum Role: string
{
    case SUPERVISOR = 'supervisor';

    case STUDENT = 'student';
}
