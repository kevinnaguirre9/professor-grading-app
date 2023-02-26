<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes;

use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, Type};
use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class InstitutionalEmailDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes
 */
final class InstitutionalEmailDoctrineType extends Type implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'institutional_email';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return InstitutionalEmail::class;
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value)
    {
        $classname = $this->customTypeClassName();

        return new $classname($value);
    }

    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value)
    {
        return $value instanceof InstitutionalEmail ? $value->value() : $value;
    }
}
