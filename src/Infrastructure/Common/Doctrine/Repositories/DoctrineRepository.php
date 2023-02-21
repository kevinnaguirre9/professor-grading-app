<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories;

use Doctrine\ODM\MongoDB\{DocumentManager, MongoDBException};
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use ProfessorGradingApp\Domain\Common\BaseEntity;

/**
 * Class DoctrineRepository
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\Repositories
 */
abstract class DoctrineRepository
{
    /**
     * @param DocumentManager $documentManager
     */
    public function __construct(private DocumentManager $documentManager)
    {
    }

    /**
     * @return DocumentManager
     */
    protected function documentManager(): DocumentManager
    {
        return $this->documentManager;
    }

    /**
     * @param BaseEntity $baseEntity
     * @return void
     * @throws MongoDBException
     */
    protected function persist(BaseEntity $baseEntity): void
    {
        $this->documentManager()->persist($baseEntity);

        $this->documentManager()->flush();
    }

    /**
     * @param BaseEntity $baseEntity
     * @return void
     * @throws MongoDBException
     */
    protected function remove(BaseEntity $baseEntity): void
    {
        $this->documentManager()->remove($baseEntity);

        $this->documentManager()->flush();
    }

    /**
     * @param string $entityClass
     * @return DocumentRepository
     */
    protected function repository(string $entityClass): DocumentRepository
    {
        return $this->documentManager()->getRepository($entityClass);
    }
}
