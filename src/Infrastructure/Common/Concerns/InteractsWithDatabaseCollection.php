<?php

namespace ProfessorGradingApp\Infrastructure\Common\Concerns;

use Doctrine\ODM\MongoDB\DocumentManager;
use MongoDB\Collection;

/**
 * Trait InteractsWithDatabaseCollection
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Concerns
 */
trait InteractsWithDatabaseCollection
{
    /**
     * @var Collection
     */
    private Collection $collection;

    /**
     * @param string $collectionName
     * @return void
     */
    protected function selectCollection(string $collectionName): void
    {
        /** @var DocumentManager $documentManager */
        $documentManager = app(DocumentManager::class);

        $database = $documentManager
            ->getConfiguration()
            ->getDefaultDB();

        $this->collection = $documentManager
            ->getClient()
            ->selectCollection($database, $collectionName);
    }
}
