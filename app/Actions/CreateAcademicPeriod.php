<?php

namespace App\Actions;

use MongoDB\Collection;
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
        $this->log('Creating academic period...');

//        $academicPeriod = $collection->find(options: [
//            'limit' => 1,
//        ])->toArray();

        return $next($collection);
    }
}
