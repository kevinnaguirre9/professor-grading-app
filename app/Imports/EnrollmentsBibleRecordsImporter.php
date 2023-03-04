<?php

namespace App\Imports;

use Doctrine\ODM\MongoDB\DocumentManager;
use MongoDB\Collection;
use Psr\Log\LoggerInterface;
use Spatie\SimpleExcel\SimpleExcelReader;

/**
 * Class EnrollmentsBibleRecordsImporter
 *
 * @package App\Imports
 */
final class EnrollmentsBibleRecordsImporter
{
    /**
     * @var Collection
     */
    private Collection $collection;

    private const COLLECTION_NAME = 'enrollments_bible';

    /**
     * @param DocumentManager $documentManager
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly DocumentManager $documentManager,
        private readonly LoggerInterface $logger,
    ) {
        $this->setDatabaseConnection();
    }

    /**
     * Save enrollments from file to database
     *
     * @param string $fileLocation
     * @return void
     */
    public function __invoke(string $fileLocation): void
    {
        try {
            $rows = SimpleExcelReader::create($fileLocation)
                ->formatHeadersUsing(fn(string $header) => strtolower($header))
                ->getRows();

            $rows->each($this->enrollmentsBibleRegistrar());

        } catch (\Exception $e) {

            $this->logger->error(
                sprintf('Importation process has some errors: %s ', $e->getMessage())
            );

            $this->logger->error('Rolling back importation process...');

            $this->collection->drop();
        }
    }

    /**
     * @return \Closure
     */
    private function enrollmentsBibleRegistrar(): \Closure
    {
        return function (array $rowProperties) {
            $this->collection->insertOne($rowProperties);
        };
    }

    /**
     * @return void
     */
    private function setDatabaseConnection(): void
    {
        //TODO: probably a InteractsWithDatabase trait would be better
        $database = $this->documentManager
            ->getConfiguration()
            ->getDefaultDB();

        $this->collection = $this->documentManager
            ->getClient()
            ->selectCollection($database, self::COLLECTION_NAME);
    }
}
