<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Common\ValueObjects;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

/**
 * Class Uuid
 *
 * @package ProfessorGradingApp\Domain\Common\ValueObjects
 */
abstract class Uuid
{
    /**
     * @var string
     */
    private readonly string $value;

    /**
     * @param string|null $value
     * @throws InvalidUuid
     */
    public function __construct(string $value = null)
    {
        $this->value = $value ? $this->ensureIsValidUuid($value) : self::generateUuid4();
    }

    /**
     * @return string
     */
    public static function generateUuid4(): string
    {
        return RamseyUuid::uuid4()->toString();
    }

    /**
     * @throws InvalidUuid
     */
    private function ensureIsValidUuid(string $uuid): string
    {
        if (!RamseyUuid::isValid($uuid))
            throw new InvalidUuid($uuid);

        return $uuid;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param Uuid $other
     * @return bool
     */
    public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
