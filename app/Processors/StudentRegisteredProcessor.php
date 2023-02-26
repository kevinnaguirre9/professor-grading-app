<?php

namespace App\Processors;

use App\Processors\Concerns\ProcessesMessage;
use ProfessorGradingApp\Application\User\Register\CreateUserCommand;
use ProfessorGradingApp\Domain\Student\Events\StudentRegistered;
use ProfessorGradingApp\Domain\User\ValueObjects\Role;

/**
 * Class StudentRegisteredProcessor
 *
 * @package App\Processors
 */
final class StudentRegisteredProcessor
{
    use ProcessesMessage;

    /**
     * @param StudentRegistered $event
     * @return void
     */
    public function __invoke(StudentRegistered $event): void
    {
        try {
            $this->logger->info(sprintf('Processing event %s', $event->getType()));

            $payload = $this->getMessagePayload($event);

            $this->logger->debug($payload);

            $createUserCommand =  new CreateUserCommand(
                data_get($payload, 'institutional_email'),
                data_get($payload, 'national_identification_number'),
                Role::STUDENT->value()
            );

            $this->commandBus->handle($createUserCommand);

        } catch (\Exception $e) {

            $this->logger->error($e->getMessage());
        }
    }
}