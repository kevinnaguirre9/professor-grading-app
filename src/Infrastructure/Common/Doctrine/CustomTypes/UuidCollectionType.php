<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes;

use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, CollectionType};
use ProfessorGradingApp\Domain\Common\ValueObjects\Uuid;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class UuidCollectionType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes
 */
abstract class UuidCollectionType extends CollectionType implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value)
    {
        $scalars = parent::convertToPHPValue($value);

        $classname = $this->customTypeClassName();

        return array_map(fn(string $uuid) => new $classname($uuid), $scalars);
    }

    /**
     * @inheritDoc
     * @throws MongoDBException
     */
    public function convertToDatabaseValue($value)
    {
        return parent::convertToDatabaseValue(
            array_map(fn(Uuid $uuid) => $uuid->value(), $value)
        );
    }
}
