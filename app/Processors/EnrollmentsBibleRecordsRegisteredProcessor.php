<?php

namespace App\Processors;

use App\Events\EnrollmentsBibleRecordsRegistered;
use App\Processors\Concerns\ProcessesMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class EnrollmentsBibleRecordsRegisteredProcessor
 *
 * @package App\Processors
 */
final class EnrollmentsBibleRecordsRegisteredProcessor implements ShouldQueue
{
    use ProcessesMessage;

    /**
     * @param EnrollmentsBibleRecordsRegistered $event
     * @return void
     */
    public function __invoke(EnrollmentsBibleRecordsRegistered $event): void
    {
        $this->logger->info('Just about to create current academic period core records...');

        //STEPS:

        //Create Academic Periods

        //Create Degrees

        //Create Subjects

        //Create Students

        //Create Professors

        //Create Classes

        //Create Enrollments

        //TODO: Option 1: just call the registrar service
        //TODO: Option 2: do everything here, instantiating commands and using the command bus

        $this->logger->info('Current academic period core records created!');
    }
}
