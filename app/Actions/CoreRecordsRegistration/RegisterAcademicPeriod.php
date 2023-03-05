<?php

namespace App\Actions\CoreRecordsRegistration;

use MongoDB\Collection;
use ProfessorGradingApp\Application\AcademicPeriod\Register\RegisterAcademicPeriodCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\HandlesCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\LogsMessage;

/**
 * Class RegisterAcademicPeriod
 *
 * @package App\Actions\CoreRecordsRegistration
 */
final class RegisterAcademicPeriod implements CoreRecordsRegistrationPipelineStage
{
    use HandlesCommand, LogsMessage;

    /**
     * @inheritDoc
     */
    public function handle(Collection $enrollmentsBibleCollection, $next): mixed
    {
        //TODO: probably created from dashboard?
        $this->log('Creating academic period...');

        $academicPeriod = $enrollmentsBibleCollection->findOne();

        $command = new RegisterAcademicPeriodCommand(
            data_get($academicPeriod, 'academic_period'),
        );

        $this->handleCommand($command);

        return $next($enrollmentsBibleCollection);
    }
}
