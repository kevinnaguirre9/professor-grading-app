<?php

namespace ProfessorGradingApp\Domain\Common\Criteria;

/**
 * Class Criteria
 *
 * @package ProfessorGradingApp\Domain\Common\Criteria
 */
final class Criteria
{
    /**
     * @param Filters $filters
     * @param Order $order
     * @param int|null $offset
     * @param int|null $limit
     */
    public function __construct(
        private readonly Filters $filters,
        private readonly Order $order,
        private readonly ?int $offset,
        private readonly ?int $limit
    ) {
    }

    /**
     * @return array
     */
    public function plainFilters(): array
    {
        return $this->filters->filters();
    }

    /**
     * @return Filters
     */
    public function filters(): Filters
    {
        return $this->filters;
    }

    /**
     * @return Order
     */
    public function order(): Order
    {
        return $this->order;
    }

    /**
     * @return int|null
     */
    public function offset(): ?int
    {
        return $this->offset;
    }

    /**
     * @return int|null
     */
    public function limit(): ?int
    {
        return $this->limit;
    }


    /**
     * @return string
     */
    public function serialize(): string
    {
        return sprintf(
            '%s~~%s~~%s~~%s',
            $this->filters->serialize(),
            $this->order->serialize(),
            $this->offset,
            $this->limit
        );
    }
}
