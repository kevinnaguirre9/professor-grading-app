<?php

namespace ProfessorGradingApp\Domain\Common\Criteria;

use ProfessorGradingApp\Domain\Common\Collection;

/**
 * Class Filters
 *
 * @package ProfessorGradingApp\Domain\Common\Criteria
 */
final class Filters extends Collection
{
    /**
     * @param array $values
     * @return static
     */
    public static function fromValues(array $values): self
    {
        return new self(array_map(self::filterBuilder(), $values));
    }

    /**
     * @return callable
     */
    private static function filterBuilder(): callable
    {
        return fn (array $values) => Filter::fromValues($values);
    }

    /**
     * @param Filter $filter
     * @return $this
     */
    public function add(Filter $filter): self
    {
        return new self(array_merge($this->items(), [$filter]));
    }

    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        return $this->items();
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        $serialization = '';

        foreach ($this->items() as $filter)
            $serialization = sprintf('%s^%s', $serialization, $filter->serialize());

        return $serialization;
    }

    /**
     * @return string
     */
    protected function type(): string
    {
        return Filter::class;
    }
}
