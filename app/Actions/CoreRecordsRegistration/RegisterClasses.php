<?php

namespace App\Actions\CoreRecordsRegistration;

use MongoDB\Collection;
use ProfessorGradingApp\Domain\Professor\Professor;
use ProfessorGradingApp\Domain\Professor\Repositories\ProfessorRepository;
use ProfessorGradingApp\Infrastructure\Common\Concerns\HandlesCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\LogsMessage;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class RegisterClasses
 *
 * @package App\Actions\CoreRecordsRegistration
 */
final class RegisterClasses implements CoreRecordsRegistrationPipelineStage
{
    use HandlesCommand, LogsMessage;

    /*
     * @param ProfessorRepository $professorRepository
     */
    public function __construct(private readonly ProfessorRepository $professorRepository)
    {
    }

    /**
     * @inheritDoc
     */
    public function handle(Collection $enrollmentsBibleCollection, $next): mixed
    {
        $this->log('Registering classes...');

        $professors = $this->professorRepository->all();

        foreach ($professors as $professor) {

            $classes = $this->fetchProfessorClasses(
                $enrollmentsBibleCollection,
                $professor
            );
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

        $classes = $collection->aggregate([
            [
                '$match' => [
                    'professor_full_name' => 'TINGO SOLEDISPA RAUL SEGUNDO'
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

        //This subject is imparted in these groups on these days
        VarDumper::dump(
            collect(iterator_to_array($classes))
                ->pluck('_id')
                ->groupBy(['subject_code', 'class_group _number'])
                ->map(fn($class) => collect($class)->pluck('weekday_number'))
                ->toArray()
        );

        dd('done');

        return collect(iterator_to_array($classes))
            ->pluck('_id')
//            ->map($this->degreeLevelMapper())
            ->toArray();
    }
}
