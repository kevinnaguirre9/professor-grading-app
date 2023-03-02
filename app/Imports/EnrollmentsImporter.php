<?php

namespace App\Imports;

use App\Imports\Filters\ChunkReadFilter;
use Doctrine\ODM\MongoDB\DocumentManager;
use MongoDB\Database;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Psr\Log\LoggerInterface;

/**
 * Class EnrollmentsImporter
 *
 * @package App\Imports
 */
final class EnrollmentsImporter
{
    private const CHUNK_SIZE = 100;

    /**
     * @var Database
     */
    private Database $connection;

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


    public function __invoke(string $fileLocation): void
    {
       $this->logger->debug('Loading file');

       $readerType = IOFactory::identify($fileLocation);

        $reader = IOFactory::createReader($readerType);

        $worksheetData = $reader->listWorksheetInfo($fileLocation);

        //Just getting total rows from first worksheet
        $totalRows = data_get($worksheetData, '0.totalRows');

        // Define how many rows we want to read for each "chunk"
        $chunkSize = 20;

        // Create a new Instance of our Read Filter
        $chunkFilter = new ChunkReadFilter();

        // Tell the Reader that we want to use the Read Filter that we've Instantiated
        $reader->setReadFilter($chunkFilter);

        // Loop to read our worksheet in "chunk size" blocks
        for ($startRow = 2; $startRow <= $totalRows; $startRow += $chunkSize) {

             $this->logger->debug(
                 'Loading WorkSheet using configurable filter for headings row 1 and for rows '
                 . $startRow .
                 ' to ' .
                 ($startRow + $chunkSize - 1)
             );

            // Tell the Read Filter, the limits on which rows we want to read this iteration
            $chunkFilter->setRows($startRow, $chunkSize);

//            $reader->setReadFilter($chunkFilter);
//
//            // Load only the rows that match our filter from $inputFileName to a PhpSpreadsheet Object
            $spreadsheet = $reader->load($fileLocation);
//
//            // Do some processing here
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $headers = array_shift($sheetData);

            $data = array_map(function ($row) use ($headers) {
                return array_combine($headers, $row);
            }, $sheetData);

            print_r($data);
        }
    }

    /**
     * @return void
     */
    private function setDatabaseConnection(): void
    {
        $database = $this->documentManager
            ->getConfiguration()
            ->getDefaultDB();

        $this->connection = $this->documentManager
            ->getClient()
            ->selectDatabase($database);
    }
}
