<?php

namespace ProfessorGradingApp\Domain\Common;

/**
 * Class Collection
 *
 * @package ProfessorGradingApp\Domain\Common
 */
abstract class Collection
{
    /**
     * @param array $items
     */
    public function __construct(private readonly array $items)
    {
        $this->assertItemsHaveTheRightType();
    }

    /**
     * @return void
     */
    public function assertItemsHaveTheRightType(): void
    {
        foreach ($this->items as $item)
            $this->instanceOf($this->type(), $item);
    }

    /**
     * @param string $class
     * @param $item
     * @return void
     */
    private function instanceOf(string $class, $item): void
    {
        if (!$item instanceof $class) {
            throw new \InvalidArgumentException(
                sprintf('The object <%s> is not an instance of <%s>', $class, $item::class)
            );
        }
    }

    /**
     * @return string
     */
    abstract protected function type(): string;

    /**
     * @return \ArrayIterator
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->items());
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items());
    }

    /**
     * @return array
     */
    public function items(): array
    {
        return $this->items;
    }
}
