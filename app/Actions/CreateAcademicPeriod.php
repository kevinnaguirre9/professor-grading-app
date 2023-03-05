<?php

namespace App\Actions;

use MongoDB\Collection;
use ProfessorGradingApp\Application\AcademicPeriod\Register\RegisterAcademicPeriodCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\HandlesCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\LogsMessage;

/**
 * Class CreateAcademicPeriod
 *
 * @package App\Actions
 */
final class CreateAcademicPeriod
{
    use HandlesCommand, LogsMessage;

    /**
     * @param Collection $collection
     * @param $next
     * @return mixed
     */
    public function __invoke(Collection $collection, $next): mixed
    {
        //TODO: probably created from dashboard?
        $this->log('Creating academic period...');

        $academicPeriod = $collection->findOne();

        $command = new RegisterAcademicPeriodCommand(
            data_get($academicPeriod, 'academic_period'),
        );

        $this->handleCommand($command);

        return $next($collection);
    }
}
