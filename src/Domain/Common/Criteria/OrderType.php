<?php

namespace ProfessorGradingApp\Domain\Common\Criteria;

/**
 * Enum OrderType
 *
 * @package ProfessorGradingApp\Domain\Common\Criteria
 */
enum OrderType: string
{
    case ASC = 'asc';

    case DESC = 'desc';

    case NONE = 'none';
}
