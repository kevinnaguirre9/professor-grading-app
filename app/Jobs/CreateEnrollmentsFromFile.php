<?php

namespace App\Jobs;

use Psr\Log\LoggerInterface;

/**
 * Class CreateEnrollmentsFromFile
 *
 * @package App\Jobs
 */
final class CreateEnrollmentsFromFile extends Job
{
    public function __invoke()
    {
        $logger = app(LoggerInterface::class);

        $logger->info('CREATING ENROLLMENTS FROM FILE...');
    }
}
