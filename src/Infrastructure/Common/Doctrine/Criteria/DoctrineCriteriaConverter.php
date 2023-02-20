<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\Criteria;

use Doctrine\Common\Collections\Expr\{Comparison, CompositeExpression};
use ProfessorGradingApp\Domain\Common\Criteria\{Criteria, Filter, FilterField, OrderBy};
use Doctrine\Common\Collections\Criteria as DoctrineCriteria;

/**
 * Class DoctrineCriteriaConverter
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\Criteria
 */
final class DoctrineCriteriaConverter
{
    /**
     * @param Criteria $criteria
     * @param array $criteriaToDoctrineFields
     */
    public function __construct(
        private readonly Criteria $criteria,
        private readonly array $criteriaToDoctrineFields = [],
    ) {
    }

    /**
     * @param Criteria $criteria
     * @param array $criteriaToDoctrineFields
     * @return DoctrineCriteria
     */
    public static function convert(
        Criteria $criteria,
        array $criteriaToDoctrineFields = [],
    ): DoctrineCriteria {

        $converter = new self($criteria, $criteriaToDoctrineFields);

        return $converter->convertToDoctrineCriteria();
    }

    /**
     * @return DoctrineCriteria
     */
    private function convertToDoctrineCriteria(): DoctrineCriteria
    {
        return new DoctrineCriteria(
            $this->buildExpression($this->criteria),
            $this->formatOrder($this->criteria),
            $this->criteria->offset(),
            $this->criteria->limit()
        );
    }

    /**
     * @param Criteria $criteria
     * @return CompositeExpression|null
     */
    private function buildExpression(Criteria $criteria): ?CompositeExpression
    {
        if (! $criteria->hasFilters())
            return null;

        return new CompositeExpression(
            CompositeExpression::TYPE_AND,
            array_map($this->buildComparison(), $criteria->plainFilters())
        );
    }

    /**
     * @return callable
     */
    private function buildComparison(): callable
    {
        return function (Filter $filter): Comparison {

            $field = $this->mapFieldValue($filter->field());

            $value = $filter->value()->value();

            return new Comparison($field, $filter->operator()->value(), $value);
        };
    }

    /**
     * @param FilterField $field
     * @return mixed|string
     */
    private function mapFieldValue(FilterField $field): mixed
    {
        return array_key_exists($field->value(), $this->criteriaToDoctrineFields)
            ? $this->criteriaToDoctrineFields[$field->value()]
            : $field->value();
    }

    /**
     * @param Criteria $criteria
     * @return array|null
     */
    private function formatOrder(Criteria $criteria): ?array
    {
        if (! $criteria->hasOrder())
            return null;

        return [
            $this->mapOrderBy($criteria->order()->orderBy()) => $criteria->order()->orderType()->value()
        ];
    }

    /**
     * @param OrderBy $field
     * @return mixed|string
     */
    private function mapOrderBy(OrderBy $field): mixed
    {
        return array_key_exists($field->value(), $this->criteriaToDoctrineFields)
            ? $this->criteriaToDoctrineFields[$field->value()]
            : $field->value();
    }
}
