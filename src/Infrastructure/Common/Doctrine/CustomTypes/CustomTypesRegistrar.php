<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes;

use Doctrine\ODM\MongoDB\Types\Type;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Concerns\InteractsWithMapper;

/**
 * Class CustomTypesRegistrar
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes
 */
final class CustomTypesRegistrar
{
    use InteractsWithMapper;

    /**
     * @var bool
     */
    private static bool $initialized = false;

    /**
     * @return void
     */
    public static function register(): void
    {
        $customTypes = self::fetch(self::mapperPath());

        if (! self::$initialized) {

            array_walk($customTypes, self::registerType());

            self::$initialized = true;
        }
    }

    /**
     * @return callable
     */
    private static function registerType(): callable
    {
        return static function (string $customTypeClassName): void {
            Type::registerType($customTypeClassName::customTypeName(), $customTypeClassName);
        };
    }

    /**
     * @return string
     */
    private static function mapperPath(): string
    {
        return 'mappings' . DIRECTORY_SEPARATOR . 'doctrine_custom_types.json';
    }
}
