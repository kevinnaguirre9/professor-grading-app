<?php

namespace App\Actions\CoreRecordsRegistration;

use MongoDB\Collection;

/**
 * Interface CoreRecordsRegistrationPipelineStage
 *
 * @package App\Actions\CoreRecordsRegistration
 */
interface CoreRecordsRegistrationPipelineStage
{
    /**
     * @param Collection $enrollmentsBibleCollection
     * @param $next
     * @return mixed
     */
    public function handle(Collection $enrollmentsBibleCollection, $next): mixed;
}
