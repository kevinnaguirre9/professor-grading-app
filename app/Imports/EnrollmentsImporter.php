<?php

namespace App\Imports;

use App\Imports\Filters\ChunkReadFilter;
use Doctrine\ODM\MongoDB\DocumentManager;
use MongoDB\Collection;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Psr\Log\LoggerInterface;

/**
 * Class EnrollmentsImporter
 *
 * @package App\Imports
 */
final class EnrollmentsImporter
{
    /**
     * Define how many rows we want to read for each "chunk"
     */
    private const CHUNK_SIZE = 100;

    /**
     * The Excel file headers
     */
    private static array $headers;

    /**
     * @var Collection
     */
    private Collection $connection;

    private const COLLECTION_NAME = 'enrollments_bible';

    /**
     * @param DocumentManager $documentManager
     * @param LoggerInterface $logger
     */
    public function __construct(
        private DocumentManager $documentManager,
        private LoggerInterface $logger,
    ) {
        $this->setDatabaseConnection();
    }

    /**
     * @param string $fileLocation
     * @return void
     * @throws Exception
     */
    public function __invoke(string $fileLocation): void
    {
        $readerType = IOFactory::identify($fileLocation);

        $reader = IOFactory::createReader($readerType);

        $worksheetData = $reader->listWorksheetInfo($fileLocation);

        $totalRows = data_get($worksheetData, '0.totalRows');

        $chunkFilter = new ChunkReadFilter();

        $reader->setReadFilter($chunkFilter);

        for ($startRow = 2; $startRow <= $totalRows; $startRow += self::CHUNK_SIZE) {

            $this->logger->debug(
                sprintf('Reading rows %s to %s', $startRow, ($startRow + self::CHUNK_SIZE - 1))
            );

            $chunkFilter->setRows($startRow, self::CHUNK_SIZE);

            $spreadsheet = $reader->load($fileLocation);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $this->setMappedHeaderKeys($sheetData);

            $enrollment = array_map($this->recordsWithKeyTransformer(), $sheetData);

            $this->connection->insertMany($enrollment);
        }
    }

    /**
     * @param array $sheetData
     * @return void
     */
    private function setMappedHeaderKeys(array $sheetData): void
    {
        if (!empty(self::$headers))
            return;

        $rawHeaders = array_shift($sheetData);

        //TODO: Map headers to database fields in a human-readable format
        self::$headers = array_map('strtolower', $rawHeaders);
    }

    /**
     * @return \Closure
     */
    private function recordsWithKeyTransformer(): \Closure
    {
        return fn($row) => array_combine(self::$headers, array_values($row));
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

        $this->connection = $this->documentManager
            ->getClient()
            ->selectCollection($database, self::COLLECTION_NAME);
    }
}
