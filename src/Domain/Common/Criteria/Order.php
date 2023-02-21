<?php

namespace ProfessorGradingApp\Domain\Common\Criteria;

/**
 * Class Order
 *
 * @package ProfessorGradingApp\Domain\Common\Criteria
 */
final class Order
{
    /**
     * @param OrderBy $orderBy
     * @param OrderType $orderType
     */
    public function __construct(private OrderBy $orderBy, private OrderType $orderType)
    {
    }

    /**
     * @param OrderBy $orderBy
     * @return Order
     */
    public static function createDesc(OrderBy $orderBy): Order
    {
        return new self($orderBy, OrderType::DESC);
    }

    /**
     * @param string|null $orderBy
     * @param string|null $order
     * @return Order
     */
    public static function fromValues(?string $orderBy, ?string $order): Order
    {
        return null === $orderBy ? self::none() : new Order(new OrderBy($orderBy), OrderType::from($order));
    }

    /**
     * @return Order
     */
    public static function none(): Order
    {
        return new Order(new OrderBy(''), OrderType::NONE);
    }

    /**
     * @return OrderBy
     */
    public function orderBy(): OrderBy
    {
        return $this->orderBy;
    }

    /**
     * @return OrderType
     */
    public function orderType(): OrderType
    {
        return $this->orderType;
    }

    /**
     * @return bool
     */
    public function isNone(): bool
    {
        return $this->orderType()->isNone();
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        return sprintf('%s.%s', $this->orderBy->value(), $this->orderType->value);
    }
}
