<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes;

use Doctrine\ODM\MongoDB\Types\Type;
use Illuminate\Support\Facades\Storage;

/**
 * Class CustomTypesRegistrar
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes
 */
final class CustomTypesRegistrar
{
    /**
     * @var bool
     */
    private static bool $initialized = false;

    /**
     * @return void
     */
    public static function register(): void
    {
        $customTypes = self::getCustomTypeClassNames();

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
     * @return array
     */
    private static function getCustomTypeClassNames(): array
    {
        $filePath = self::customTypesMapperFilePath();

        if (! Storage::exists($filePath))
            throw new \RuntimeException('Custom types map file not found');

        $fileContents = Storage::get($filePath);

        $customTypes = json_decode($fileContents, true);

        return array_values($customTypes);
    }

    /**
     * @return string
     */
    private static function customTypesMapperFilePath(): string
    {
        return 'mappings' . DIRECTORY_SEPARATOR . 'doctrine_custom_types.json';
    }
}
