<?php

namespace App\Jobs;

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
     * @return void
     */
    public function __invoke(): void
    {
        $logger = app(LoggerInterface::class);

        $logger->info('CREATING ENROLLMENTS FROM FILE...');

        $logger->info('PATH IS: ' . $this->enrollmentsFilePath);

        $logger->info(
            Storage::exists($this->enrollmentsFilePath) ? 'FILE EXISTS' : 'FILE DOES NOT EXIST'
        );

        $logger->info('ENROLLMENTS CREATED FROM FILE');

        $logger->info('DELETING FILE...');

        Storage::delete($this->enrollmentsFilePath);
    }
}
