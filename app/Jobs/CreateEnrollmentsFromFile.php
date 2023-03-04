<?php

namespace App\Jobs;

use App\Imports\EnrollmentsImporter;
use Illuminate\Support\Facades\Storage;
use Psr\Log\LoggerInterface;

/**
 * Class CreateEnrollmentsFromFile
 *
 * @package App\Jobs
 */
final class CreateEnrollmentsFromFile extends Job
{
    /**
     * @param string $enrollmentsFilePath
     */
    public function __construct(private readonly string $enrollmentsFilePath)
    {
    }

    /**
     * @param LoggerInterface $logger
     * @param EnrollmentsImporter $importer
     * @return void
     */
    public function __invoke(LoggerInterface $logger, EnrollmentsImporter $importer): void
    {
        $logger->info('Creating enrollments from file...');

        $importer->__invoke(Storage::path($this->enrollmentsFilePath));

        Storage::delete($this->enrollmentsFilePath);

        $logger->info('Enrollments created from file!');

        //TODO: DISPATCH EVENT TO CREATE MASTER RECORDS USING APPLICATION SERVICES
    }
}
