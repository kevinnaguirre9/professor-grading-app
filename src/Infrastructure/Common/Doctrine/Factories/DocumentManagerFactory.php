<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\Factories;

use Doctrine\ODM\MongoDB\{Configuration, DocumentManager, Mapping\Driver\XmlDriver};
use MongoDB\Client;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\CustomTypesRegistrar;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Mappings\XmlMappingDocumentsSearcher;

/**
 * Class DocumentManagerFactory
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\Factories
 */
final class DocumentManagerFactory
{
    private const HYDRATORS_DIR = __DIR__ . '/../Hydrators';

    private const HYDRATORS_NAMESPACE = 'ProfessorGradingApp\Infrastructure\Common\Doctrine\Hydrators';

    /**
     * @return DocumentManager
     */
    public static function create() : DocumentManager
    {
        $client = self::createClient();

        $config = self::createConfiguration();

        $documentManager = DocumentManager::create($client, $config);

        CustomTypesRegistrar::register();

        $documentManager->getSchemaManager()->ensureIndexes();

        return $documentManager;
    }

    /**
     * @return Client
     */
    private static function createClient() : Client
    {
        return new Client(
            uri: config('database.connections.mongodb.uri'),
            driverOptions: self::driverOptions(),
        );
    }

    /**
     * @return Configuration
     */
    private static function createConfiguration() : Configuration
    {
        $config = new Configuration();

        $config->setHydratorDir(self::HYDRATORS_DIR);

        $config->setHydratorNamespace(self::HYDRATORS_NAMESPACE);

        $config->setMetadataDriverImpl(
            new XmlDriver(self::mappingDocumentsPaths())
        );

        $config->setDefaultDB(config('database.connections.mongodb.database'));

        return $config;
    }

    /**
     * @return array
     */
    private static function driverOptions() : array
    {
        return [
            'typeMap' => DocumentManager::CLIENT_TYPEMAP,
        ];
    }

    /**
     * @return array
     */
    private static function mappingDocumentsPaths() : array
    {
        return XmlMappingDocumentsSearcher::search();
    }
}
