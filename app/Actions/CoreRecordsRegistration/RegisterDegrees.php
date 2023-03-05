<?php

namespace App\Actions\CoreRecordsRegistration;

use MongoDB\Collection;
use ProfessorGradingApp\Application\Degree\Register\RegisterDegreeCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\HandlesCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\LogsMessage;

/**
 * Class RegisterDegrees
 *
 * @package App\Actions\CoreRecordsRegistration
 */
final class RegisterDegrees implements CoreRecordsRegistrationPipelineStage
{
    use HandlesCommand, LogsMessage;

    /**
     * @inheritDoc
     */
    public function handle(Collection $enrollmentsBibleCollection, $next): mixed
    {
        $this->log('Registering degrees...');

        $degrees = $enrollmentsBibleCollection
            ->distinct('student_degree_followed');

        foreach ($degrees as $degree)
            $this->handleCommand(new RegisterDegreeCommand($degree));

        return $next($enrollmentsBibleCollection);
    }
}
