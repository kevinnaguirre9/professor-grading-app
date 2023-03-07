<?php

namespace App\Actions\CoreRecordsRegistration;

use MongoDB\Collection;
use ProfessorGradingApp\Infrastructure\Common\Concerns\HandlesCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\LogsMessage;

/**
 * Class RegisterEnrollments
 *
 * @package App\Actions\CoreRecordsRegistration
 */
final class RegisterEnrollments implements CoreRecordsRegistrationPipelineStage
{
    use HandlesCommand, LogsMessage;

    /**
     * @inheritDoc
     */
    public function handle(Collection $enrollmentsBibleCollection, $next): mixed
    {
        $this->log('Registering enrollments...');

        return $next($enrollmentsBibleCollection);
    }
}
