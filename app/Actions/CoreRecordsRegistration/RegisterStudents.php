<?php

namespace App\Actions\CoreRecordsRegistration;

use MongoDB\Collection;
use ProfessorGradingApp\Application\Student\Register\RegisterStudentCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\HandlesCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\LogsMessage;

/**
 * Class RegisterStudents
 *
 * @package App\Actions\CoreRecordsRegistration
 */
final class RegisterStudents implements CoreRecordsRegistrationPipelineStage
{
    use HandlesCommand, LogsMessage;

    /**
     * @inheritDoc
     */
    public function handle(Collection $enrollmentsBibleCollection, $next): mixed
    {
        $this->log('Registering students...');

        $students = $enrollmentsBibleCollection->aggregate([
            [
                '$group' => [
                    '_id' => [
                        'student_full_name' => '$student_full_name',
                        'national_identification_number' => '$national_identification_number',
                        'student_personal_email' => '$student_personal_email',
                        'student_institutional_email' => '$student_institutional_email',
                        'student_mobile_phone' => '$student_mobile_phone',
                        'student_landline_phone' => '$student_landline_phone',
                    ],
                ],
            ],
        ]);

        foreach ($students as $student) {

            $command = new RegisterStudentCommand(
                fullName: trim(data_get($student, '_id.student_full_name')),
                institutionalEmail: data_get($student, '_id.student_institutional_email'),
                nationalIdentificationNumber: data_get($student, '_id.national_identification_number'),
                personalEmail: data_get($student, '_id.student_personal_email'),
                mobileNumber: data_get($student, '_id.student_mobile_phone'),
                landlineNumber: data_get($student, '_id.student_landline_phone'),
            );

            $this->handleCommand($command);
        }

        return $next($enrollmentsBibleCollection);
    }
}
