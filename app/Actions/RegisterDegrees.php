<?php

namespace App\Actions;

use MongoDB\Collection;
use ProfessorGradingApp\Application\Degree\Register\RegisterDegreeCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\HandlesCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\LogsMessage;

/**
 * Class RegisterDegrees
 *
 * @package App\Actions
 */
final class RegisterDegrees
{
    use HandlesCommand, LogsMessage;

    /**
     * @param Collection $collection
     * @param $next
     * @return mixed
     */
    public function __invoke(Collection $collection, $next): mixed
    {
        $this->log('Registering degrees...');

        $degrees = $collection->distinct('student_degree_followed');

        foreach ($degrees as $degree)
            $this->handleCommand(new RegisterDegreeCommand($degree));

        return $next($collection);
    }
}
