<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\Mappings;

use ProfessorGradingApp\Infrastructure\Common\Doctrine\Concerns\InteractsWithMapper;

/**
 * Class XmlMappingDocumentsSearcher
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\Mappings
 */
final class XmlMappingDocumentsSearcher
{
    use InteractsWithMapper;

    /**
     * @return array
     */
    public static function search(): array
    {
        return self::fetch(self::mapperPath());
    }

    /**
     * @return string
     */
    private static function mapperPath(): string
    {
        return 'mappings' . DIRECTORY_SEPARATOR . 'doctrine_xml_documents.json';
    }
}
