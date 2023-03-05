<?php

namespace App\Actions;

use MongoDB\Collection;
use ProfessorGradingApp\Application\Subject\Register\RegisterSubjectCommand;
use ProfessorGradingApp\Domain\Degree\Repositories\DegreeRepository;
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

    public function __construct(private readonly DegreeRepository $degreeRepository)
    {
    }

    /**
     * @param Collection $collection
     * @param $next
     * @return mixed
     */
    public function __invoke(Collection $collection, $next): mixed
    {
        $this->log('Registering subjects...');

        $subjects = $this->fetchSubjects($collection);

        foreach ($subjects as $subject) {

            $subjectCode = data_get($subject, '_id.subject_code');

            $subjectDegrees = $this->fetchSubjectDegrees($collection, $subjectCode);

            $this->handleCommand(new RegisterSubjectCommand(
                $subjectCode,
                data_get($subject, '_id.subject_name'),
                $subjectDegrees
            ));
        }

        return $next($collection);
    }

    /**
     * @param Collection $collection
     * @return \Traversable
     */
    private function fetchSubjects(Collection $collection): \Traversable
    {
        return $collection->aggregate([
            [
                '$group' => [
                    '_id' => [
                        'subject_code' => '$subject_code',
                        'subject_name' => '$subject_name',
                    ],
                ],
            ],
        ]);
    }

    /**
     * @param Collection $collection
     * @param string $subjectCode
     * @return array
     */
    private function fetchSubjectDegrees(Collection $collection, string $subjectCode): array
    {
        $subjectDegrees = $collection->aggregate([
            [
                '$match' => [
                    'subject_code' => [
                        '$eq' => $subjectCode,
                    ],
                ],
            ],
            [
                '$group' => [
                    '_id' => [
                        'student_degree_followed' => '$student_degree_followed',
                        'semester_level' => '$semester_level',
                    ],
                ],
            ],
        ]);

        return collect(iterator_to_array($subjectDegrees))
            ->pluck('_id')
            ->map($this->degreeLevelMapper())
            ->toArray();
    }

    /**
     * @return \Closure
     */
    private function degreeLevelMapper(): \Closure
    {
        return function ($degreeLevel) {

            $Degree = $this->degreeRepository->findByName(
                data_get($degreeLevel, 'student_degree_followed')
            );

            if(!$Degree)
                return [];

            return [
                'degree_id' => (string) $Degree->id(),
                'level' => data_get($degreeLevel, 'semester_level'),
            ];
        };
    }
}
