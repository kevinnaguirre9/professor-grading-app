<?php

namespace ProfessorGradingApp\Domain\ClassInspectionRequest\ValueObjects;

use ProfessorGradingApp\Domain\ClassInspectionRequest\Exceptions\InvalidClassInspectionRequestStatus;

/**
 * Enum ClassInspectionRequestStatus
 *
 * @package ProfessorGradingApp\Domain\ClassInspectionRequest\ValueObjects
 */
enum ClassInspectionRequestStatus : string
{
    case PENDING = 'pending';

    case APPROVED = 'approved';

    case REJECTED = 'rejected';

    case INSPECTED = 'inspected';

    /**
     * @param string $value
     * @return static
     * @throws InvalidClassInspectionRequestStatus
     */
    public static function fromValue(string $value): self
    {
        $cases = self::allValues();

        if (!in_array($value, $cases, true))
            throw new InvalidClassInspectionRequestStatus($value);

        return self::from($value);
    }

    /**
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->equals(self::PENDING);
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->equals(self::APPROVED);
    }

    /**
     * @return bool
     */
    public function isRejected(): bool
    {
        return $this->equals(self::REJECTED);
    }

    /**
     * @return bool
     */
    public function isInspected(): bool
    {
        return $this->equals(self::INSPECTED);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param ClassInspectionRequestStatus $other
     * @return bool
     */
    public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    /**
     * @return array
     */
    public static function allValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
