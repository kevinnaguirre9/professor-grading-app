<?php

namespace App\Actions\CoreRecordsRegistration;

use MongoDB\Collection;

/**
 * Class RegisterProfessors
 *
 * @package App\Actions\CoreRecordsRegistration
 */
final class RegisterProfessors implements CoreRecordsRegistrationPipelineStage
{
    /**
     * @inheritDoc
     */
    public function handle(Collection $enrollmentsBibleCollection, $next): mixed
    {
        return $next($enrollmentsBibleCollection);
    }
}
