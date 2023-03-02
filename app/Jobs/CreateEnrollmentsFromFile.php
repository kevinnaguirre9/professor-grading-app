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

    public function __invoke(LoggerInterface $logger, EnrollmentsImporter $importer): void
    {
        $logger->info('Creating enrollments from file...');

        $importer->__invoke(Storage::path($this->enrollmentsFilePath));

        //Deletes file
//        Storage::delete($this->enrollmentsFilePath);
    }
}
