<?php

namespace App\Actions\CoreRecordsRegistration;

use MongoDB\Collection;
use ProfessorGradingApp\Application\Professor\Register\RegisterProfessorCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\HandlesCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\LogsMessage;

/**
 * Class RegisterProfessors
 *
 * @package App\Actions\CoreRecordsRegistration
 */
final class RegisterProfessors implements CoreRecordsRegistrationPipelineStage
{
    use HandlesCommand, LogsMessage;

    /**
     * @inheritDoc
     */
    public function handle(Collection $enrollmentsBibleCollection, $next): mixed
    {
        $professors = $enrollmentsBibleCollection->aggregate([
            [
                '$group' => [
                    '_id' => [
                        'professor_full_name' => '$professor_full_name',
                    ],
                ],
            ],
        ]);

        foreach ($professors as $professor) {

            $command = new RegisterProfessorCommand(
                data_get($professor, '_id.professor_full_name'),
            );

            $this->handleCommand($command);
        }

        return $next($enrollmentsBibleCollection);
    }
}
