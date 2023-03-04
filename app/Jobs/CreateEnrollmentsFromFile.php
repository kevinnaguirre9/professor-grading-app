<?php

namespace App\Jobs;

use App\Events\EnrollmentsBibleRecordsRegistered;
use App\Imports\EnrollmentsBibleRecordsImporter;
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
     * @param EnrollmentsBibleRecordsImporter $importer
     * @param LoggerInterface $logger
     * @return void
     */
    public function __invoke(EnrollmentsBibleRecordsImporter $importer, LoggerInterface $logger): void
    {
        $logger->info('Registering enrollments bible from file...');

        $importer->__invoke(Storage::path($this->enrollmentsFilePath));

        Storage::delete($this->enrollmentsFilePath);

        $logger->info('Enrollments bible records created from file!');

        event(new EnrollmentsBibleRecordsRegistered);
    }
}
