<?php

namespace ProfessorGradingApp\Domain\Tutorship\Criteria;

use ProfessorGradingApp\Domain\Common\Criteria\Criteria;
use ProfessorGradingApp\Domain\Common\Criteria\FilterOperator;
use ProfessorGradingApp\Domain\Common\Criteria\Filters;
use ProfessorGradingApp\Domain\Common\Criteria\Order;
use ProfessorGradingApp\Domain\Common\Criteria\OrderType;
use ProfessorGradingApp\Domain\Common\Exceptions\EmptyFilters;
use ProfessorGradingApp\Domain\Common\ValueObjects\AcademicPeriod\AcademicPeriodId;

/**
 * Class TutorshipCriteria
 *
 * @package ProfessorGradingApp\Domain\Tutorship\Criteria
 */
final class TutorshipCriteria
{
    private const DEFAULT_LIMIT = 25;

    private int $offset;

    private int $limit;

    /**
     * @param array $filters
     * @param int|null $limit
     * @param int $page
     */
    public function __construct(
        private array $filters,
        int $limit = null,
        int $page = 1,
    ) {
        $this->setLimit($limit);

        $this->setOffset($page);


    }

    /**
     * @param AcademicPeriodId $academicPeriodId
     * @return $this
     */
    public function withAcademicPeriodFilter(AcademicPeriodId $academicPeriodId): self
    {
        return $this->addFilter(
            'academicPeriodId',
            FilterOperator::EQUAL->value(),
            $academicPeriodId->value()
        );
    }

    /**
     * @param string $field
     * @param string $operator
     * @param $value
     * @return $this
     */
    private function addFilter(string $field, string $operator, $value): self
    {
        $this->filters[] = [
            'field'     => $field,
            'operator'  => $operator,
            'value'     => $value,
        ];

        return $this;
    }

    /**
     * @param int|null $limit
     * @return void
     */
    public function setLimit(int $limit = null): void
    {
        $this->limit = $limit ?? self::DEFAULT_LIMIT;
    }

    /**
     * @param int $page
     * @return void
     */
    private function setOffset(int $page) : void
    {
        $this->offset = ($page - 1) * $this->limit;
    }

    /**
     * @return Criteria
     * @throws EmptyFilters
     */
    public function build(): Criteria
    {
        if (empty($this->filters))
            throw new EmptyFilters;

        $filters = Filters::fromValues($this->filters);

        $order = Order::fromValues(
            'registeredAt',
            OrderType::DESC->value(),
        );

        return new Criteria(
            $filters,
            $order,
            $this->offset,
            $this->limit,
        );
    }
}
