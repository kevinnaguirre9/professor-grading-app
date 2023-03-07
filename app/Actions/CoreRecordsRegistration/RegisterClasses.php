<?php

namespace App\Actions\CoreRecordsRegistration;

use Illuminate\Support\Collection as IlluminateCollection;
use MongoDB\Collection;
use ProfessorGradingApp\Application\CourseClass\Register\RegisterCourseClassCommand;
use ProfessorGradingApp\Domain\Professor\Professor;
use ProfessorGradingApp\Domain\Professor\Repositories\ProfessorRepository;
use ProfessorGradingApp\Domain\Subject\Repositories\SubjectRepository;
use ProfessorGradingApp\Infrastructure\Common\Concerns\HandlesCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\LogsMessage;

/**
 * Class RegisterClasses
 *
 * @package App\Actions\CoreRecordsRegistration
 */
final class RegisterClasses implements CoreRecordsRegistrationPipelineStage
{
    use HandlesCommand, LogsMessage;

    /**
     * @param ProfessorRepository $professorRepository
     * @param SubjectRepository $subjectRepository
     */
    public function __construct(
        private readonly ProfessorRepository $professorRepository,
        private readonly SubjectRepository $subjectRepository,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function handle(Collection $enrollmentsBibleCollection, $next): mixed
    {
        $this->log('Registering classes...');

        $professors = $this->professorRepository->all();

        foreach ($professors as $Professor) {

            $classes = $this->fetchProfessorClasses(
                $enrollmentsBibleCollection,
                $Professor
            );

            foreach ($classes as $class) {

                $this->handleCommand(
                    new RegisterCourseClassCommand(
                        data_get($class, 'group_number'),
                        data_get($class, 'daily_schedules'),
                        data_get($class, 'subject_id'),
                        data_get($class, 'professor_id'),
                    )
                );
            }
        }

        return $next($enrollmentsBibleCollection);
    }

    /**
     * @param Collection $collection
     * @param Professor $Professor
     * @return array
     */
    private function fetchProfessorClasses(Collection $collection, Professor $Professor): array
    {
        $professorFullName = $Professor->fullName();

        $professorId = (string) $Professor->id();

        $classes = $collection->aggregate([
            [
                '$match' => [
                    'professor_full_name' => $professorFullName
                ]
            ],
            [
                '$group' => [
                    '_id' => [
                        'subject_code' => '$subject_code',
                        'class_group_number' => '$class_group_number',
                        'weekday_number' => '$weekday_number',
                        'start_class_time' => '$start_class_time',
                        'end_class_time' => '$end_class_time',
                    ],
                ],
            ],
        ]);

        $classes = collect(iterator_to_array($classes))
            ->pluck('_id')
            ->groupBy(['subject_code'])
            ->toArray();

        $mappedData = [];

        //TODO: bad as hell, refactor this somehow someday (maybe)
        foreach ($classes as $classCode => $class) {

            $subjectId = $this->subjectRepository->findByCode($classCode)?->id();

            if (! $subjectId)
                continue;

            $classCollection = collect($class);

            $groups = $classCollection
                ->unique('class_group_number')
                ->pluck('class_group_number')
                ->toArray();

            foreach ($groups as $group) {

                $mappedData[] = [
                    'subject_id' => (string) $subjectId,
                    'professor_id' => $professorId,
                    'group_number' => $group,
                    'daily_schedules' => $this->getClassGroupDailySchedules($classCollection, $group),
                ];
            }
        }

        return $mappedData;
    }

    /**
     * @param IlluminateCollection $class
     * @param int $group
     * @return array
     */
    private function getClassGroupDailySchedules(IlluminateCollection $class, int $group): array
    {
        $classGroupDailySchedules = [];

        $classGroup = $class
            ->where('class_group_number', $group);

        $weekdays = $classGroup
            ->unique('weekday_number')
            ->pluck('weekday_number')
            ->toArray();

        foreach ($weekdays as $weekday) {

            $ClassGroupWeekday = $classGroup
                ->where('weekday_number', $weekday);

            $ClassGroupWeekday->min('start_class_time');

            $ClassGroupWeekday->max('end_class_time');

            $classGroupDailySchedules[] = [
                'weekday' => $weekday,
                'start_time' => $ClassGroupWeekday->min('start_class_time'),
                'end_time' => $ClassGroupWeekday->max('end_class_time'),
            ];
        }

        return $classGroupDailySchedules;
    }
}
