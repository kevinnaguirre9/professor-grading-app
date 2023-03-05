<?php

namespace App\Processors;

use App\Actions\CoreRecordsRegistration\RegisterAcademicPeriod;
use App\Actions\CoreRecordsRegistration\RegisterDegrees;
use App\Actions\CoreRecordsRegistration\RegisterProfessors;
use App\Actions\CoreRecordsRegistration\RegisterStudents;
use App\Actions\CoreRecordsRegistration\RegisterSubjects;
use App\Events\EnrollmentsBibleRecordsRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Pipeline\Pipeline;
use MongoDB\Collection;
use ProfessorGradingApp\Infrastructure\Common\Concerns\{InteractsWithDatabaseCollection, LogsMessage};

/**
 * Class EnrollmentsBibleRecordsRegisteredProcessor
 *
 * @package App\Processors
 */
final class EnrollmentsBibleRecordsRegisteredProcessor implements ShouldQueue
{
    use InteractsWithDatabaseCollection, LogsMessage;

    /**
     * Enrollments bible collection name
     */
    private const COLLECTION_NAME = 'enrollments_bible';

    /**
     * @param EnrollmentsBibleRecordsRegistered $event
     * @return void
     */
    public function __invoke(EnrollmentsBibleRecordsRegistered $event): void
    {
        try {
            $this->selectCollection(self::COLLECTION_NAME);

            $this->pipeline($this->collection)
                ->then($this->onSuccess());

        } catch (\Throwable $e) {

            $this->log('Error processing enrollments bible records: ' . $e->getMessage());

            call_user_func($this->sendFailureImportationEmail());
        }
    }

    /**
     * @param Collection $collection
     * @return Pipeline
     */
    private function pipeline(Collection $collection): Pipeline
    {
        /** @var Pipeline $Pipeline */
        $Pipeline = app(Pipeline::class);

        return $Pipeline->send($collection)->through([
            RegisterAcademicPeriod::class,
            RegisterDegrees::class,
            RegisterSubjects::class,
            RegisterStudents::class,
            RegisterProfessors::class,
            //Create Classes
            //Create Enrollments
        ]);
    }

    /**
     * @return \Closure
     */
    private function onSuccess(): \Closure
    {
        return function() {
//            $callbacks = [$this->dropCollection(), $this->sendSuccessImportationEmail()];
            $callbacks = [$this->sendSuccessImportationEmail()];

            foreach ($callbacks as $callback)
                $callback();
        };
    }

    /**
     * @return \Closure
     */
    private function dropCollection(): \Closure
    {
        return fn() => $this->collection->drop();
    }

    /**
     * @return \Closure
     */
    private function sendSuccessImportationEmail(): \Closure
    {
        //TODO: dispatch event to send email
        return fn() => $this->log('Email sent!');
    }

    /**
     * @return \Closure
     */
    private function sendFailureImportationEmail(): \Closure
    {
        //TODO: dispatch event to send email
        return fn() => $this->log('Failure Email sent!');
    }
}
