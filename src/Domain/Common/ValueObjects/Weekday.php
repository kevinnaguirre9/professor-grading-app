<?php

namespace ProfessorGradingApp\Domain\Common\ValueObjects;

/**
 * Enum Weekday
 *
 * @package ProfessorGradingApp\Domain\Common\ValueObjects
 */
enum Weekday : int
{
    case MONDAY = 1;

    case TUESDAY = 2;

    case WEDNESDAY = 3;

    case THURSDAY = 4;

    case FRIDAY = 5;

    case SATURDAY = 6;

    case SUNDAY = 7;
}
