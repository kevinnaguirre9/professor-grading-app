<?php

namespace ProfessorGradingApp\Domain\Common\Criteria;

/**
 * Enum FilterOperator
 *
 * @package ProfessorGradingApp\Domain\Common\Criteria
 */
enum FilterOperator: string
{
    case EQUAL = '=';

    case NOT_EQUAL = '!=';

    case GREATER_THAN = '>';

    case GREATER_THAN_OR_EQUAL = '>=';

    case LESS_THAN = '<';

    case LESS_THAN_OR_EQUAL = '<=';

    case LIKE = 'LIKE';

    case NOT_LIKE = 'NOT LIKE';

    case IN = 'IN';

    case NOT_IN = 'NOT IN';

    case IS_NULL = 'IS NULL';

    case IS_NOT_NULL = 'IS NOT NULL';

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
