<?php

namespace ProfessorGradingApp\Domain\Grade\ValueObjects;

/**
 * Enum Rating
 *
 * @package ProfessorGradingApp\Domain\Grade\ValueObjects
 */
enum Rating: int
{
    CASE DID_NOT_ATTEND = 0;

    CASE BAD = 1;

    CASE REGULAR = 2;

    CASE GOOD = 3;
}
