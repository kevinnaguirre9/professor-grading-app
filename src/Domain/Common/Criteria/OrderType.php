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

    /**
     * @return bool
     */
    public function isNone(): bool
    {
        return $this->equals(self::NONE);
    }

    /**
     * @param OrderType $OrderType
     * @return bool
     */
    public function equals(self $OrderType): bool
    {
        return $this->value() === $OrderType->value();
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
