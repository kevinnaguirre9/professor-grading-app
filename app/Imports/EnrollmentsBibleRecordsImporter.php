<?php

namespace App\Imports;

use ProfessorGradingApp\Infrastructure\Common\Doctrine\Concerns\InteractsWithDatabaseCollection;
use Psr\Log\LoggerInterface;
use Spatie\SimpleExcel\SimpleExcelReader;

/**
 * Class EnrollmentsBibleRecordsImporter
 *
 * @package App\Imports
 */
final class EnrollmentsBibleRecordsImporter
{
    use InteractsWithDatabaseCollection;

    private const COLLECTION_NAME = 'enrollments_bible';

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(private readonly LoggerInterface $logger)
    {
        $this->selectCollection(self::COLLECTION_NAME);
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
}
