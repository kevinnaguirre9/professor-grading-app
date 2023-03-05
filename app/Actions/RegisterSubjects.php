<?php

namespace App\Actions;

use MongoDB\Collection;
use ProfessorGradingApp\Application\Subject\Register\RegisterSubjectCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\HandlesCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\LogsMessage;

/**
 * Class RegisterSubjects
 *
 * @package App\Actions
 */
final class RegisterSubjects
{
    use HandlesCommand, LogsMessage;

    /**
     * @param Collection $collection
     * @param $next
     * @return mixed
     */
    public function __invoke(Collection $collection, $next): mixed
    {
        $this->log('Registering subjects...');

        $subjects = $collection->aggregate([
            [
                '$group' => [
                    '_id' => [
                        'subject_code' => '$subject_code',
                        'subject_name' => '$subject_name',
                    ],
                ],
            ],
        ]);

        foreach ($subjects as $subject) {

            $this->handleCommand(new RegisterSubjectCommand(
                data_get($subject, '_id.subject_code'),
                data_get($subject, '_id.subject_name'),
            ));
        }

        return $next($collection);
    }
}
