<?php

namespace ProfessorGradingApp\Domain\Common\Criteria;

/**
 * Class Filter
 *
 * @package ProfessorGradingApp\Domain\Common\Criteria
 */
final class Filter
{
    /**
     * @param FilterField $field
     * @param FilterOperator $operator
     * @param FilterValue $value
     */
    public function __construct(
        private readonly FilterField $field,
        private readonly FilterOperator $operator,
        private readonly FilterValue $value
    ) {
    }

    /**
     * @param array $values
     * @return static
     */
    public static function fromValues(array $values): self
    {
        return new self(
            new FilterField($values['field']),
            FilterOperator::from($values['operator']),
            new FilterValue($values['value'])
        );
    }

    /**
     * @return FilterField
     */
    public function field(): FilterField
    {
        return $this->field;
    }

    /**
     * @return FilterOperator
     */
    public function operator(): FilterOperator
    {
        return $this->operator;
    }

    /**
     * @return FilterValue
     */
    public function value(): FilterValue
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        return sprintf('%s.%s.%s', $this->field->value(), $this->operator->value, $this->value->value());
    }
}
