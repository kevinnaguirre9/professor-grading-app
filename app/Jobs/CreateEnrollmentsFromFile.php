<?php

namespace App\Jobs;

use App\Events\EnrollmentsBibleRecordsRegistered;
use App\Imports\EnrollmentsBibleRecordsImporter;
use Illuminate\Support\Facades\Storage;
use ProfessorGradingApp\Infrastructure\Common\Concerns\LogsMessage;

/**
 * Class CreateEnrollmentsFromFile
 *
 * @package App\Jobs
 */
final class CreateEnrollmentsFromFile extends Job
{
    use LogsMessage;

    /**
     * @param string $enrollmentsFilePath
     */
    public function __construct(private readonly string $enrollmentsFilePath)
    {
    }

    /**
     * @param EnrollmentsBibleRecordsImporter $importer
     * @return void
     */
    public function __invoke(EnrollmentsBibleRecordsImporter $importer): void
    {
        $this->log('Registering enrollments bible from file...');

        $importer->__invoke(Storage::path($this->enrollmentsFilePath));

        Storage::delete($this->enrollmentsFilePath);

        $this->log('Enrollments bible records created from file!');

        event(new EnrollmentsBibleRecordsRegistered);
    }
}
