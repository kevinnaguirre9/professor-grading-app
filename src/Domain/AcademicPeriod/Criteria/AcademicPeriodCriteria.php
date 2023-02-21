<?php

namespace ProfessorGradingApp\Domain\AcademicPeriod\Criteria;

use ProfessorGradingApp\Domain\Common\Criteria\{Criteria, FilterOperator, Filters, Order};
use ProfessorGradingApp\Domain\Common\Exceptions\EmptyReportFilters;

/**
 * Class AcademicPeriodCriteria
 *
 * @package ProfessorGradingApp\Domain\AcademicPeriod\Criteria
 */
final class AcademicPeriodCriteria
{
    /**
     * @param array $filters
     */
    public function __construct(private array $filters = [])
    {
    }

    /**
     * @param bool $isActive
     * @param FilterOperator $operator
     * @return $this
     */
    public function withIsActiveFilter(bool $isActive, FilterOperator $operator = FilterOperator::EQUAL): self
    {
        $this->filters[] = [
            'field'    => 'isActive',
            'operator' => $operator->value(),
            'value'    => $isActive,
        ];

        return $this;
    }

    /**
     * @return void
     */
    private function cleanFilters(): void
    {
        $this->filters = [];
    }

    /**
     * @return void
     * @throws EmptyReportFilters
     */
    private function validateFilters(): void
    {
        if (empty($this->filters))
            throw new EmptyReportFilters();
    }

    /**
     * @return array
     */
    private function filters(): array
    {
        return $this->filters;
    }

    /**
     * @return Criteria
     * @throws EmptyReportFilters
     */
    public function build(): Criteria
    {
        $this->validateFilters();

        $Filters = Filters::fromValues($this->filters());

        $Order = Order::fromValues('registeredAt', 'desc');

        $this->cleanFilters();

        return new Criteria($Filters, $Order);
    }
}
