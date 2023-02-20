<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\Factories;

use Doctrine\ODM\MongoDB\{Configuration, DocumentManager};
use Doctrine\ODM\MongoDB\Mapping\Driver\SimplifiedXmlDriver;
use MongoDB\Client;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\CustomTypesRegistrar;

/**
 * Class DocumentMangerFactory
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\Factories
 */
final class DocumentMangerFactory
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
            uri: self::connectionUri(),
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

        //TODO: Create a console command that finds all the mapping files paths/namespaces
        $config->setMetadataDriverImpl(
            new SimplifiedXmlDriver([
                '/app/src/Infrastructure/AcademicPeriod/Repositories/Doctrine' => 'ProfessorGradingApp\Domain\AcademicPeriod'
            ])
        );

        $config->setDefaultDB(self::databaseName());

        return $config;
    }

    /**
     * @return string
     */
    private static function databaseName() : string
    {
        return config('database.connections.mongodb.database');
    }

    /**
     * @return string
     */
    private static function connectionUri() : string
    {
        return config('database.connections.mongodb.uri');
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
}
