<?php

namespace App\Processors;

use App\Processors\Concerns\ProcessesMessage;
use ProfessorGradingApp\Application\Student\Update\UpdateStudentCommand;
use ProfessorGradingApp\Application\User\Register\CreateUserCommand;
use ProfessorGradingApp\Domain\Student\Events\StudentRegistered;
use ProfessorGradingApp\Domain\User\User;
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
                data_get($payload, 'student.institutional_email'),
                data_get($payload, 'student.national_identification_number'),
                data_get($payload, 'student.full_name'),
                Role::STUDENT->value(),
                data_get($payload, 'student.id')
            );

            /** @var User $User */
            $User = $this->commandBus->handle($createUserCommand);

            $updateStudentCommand = new UpdateStudentCommand(
                data_get($payload, 'student.id'),
                $User->id()
            );

            $this->commandBus->handle($updateStudentCommand);

        } catch (\Exception $e) {

            $this->logger->error($e->getMessage());
        }
    }
}
