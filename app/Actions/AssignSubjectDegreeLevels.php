<?php

namespace App\Actions;

use MongoDB\Collection;
use ProfessorGradingApp\Infrastructure\Common\Concerns\HandlesCommand;
use ProfessorGradingApp\Infrastructure\Common\Concerns\LogsMessage;

/**
 * Class AssignSubjectDegreeLevels
 *
 * @package App\Actions
 */
final class AssignSubjectDegreeLevels
{
    use HandlesCommand, LogsMessage;

    /**
     * @param Collection $collection
     * @param $next
     * @return mixed
     */
    public function __invoke(Collection $collection, $next): mixed
    {
        $this->log('Assigning subject degree levels...');

        //TODO: fetch subjects, find degrees subject is offered to, and assign them to the subject.

//        $subjects = $collection->aggregate([
//            [
//                '$match' => [
//                    'subject_name' => [
//                        '$eq' => 'PROGRAMACIÓN',
//                    ],
//                ],
//            ],
//            [
//                '$group' => [
//                    '_id' => [
//                        'student_degree_followed' => '$student_degree_followed',
//                        'semester_level' => '$semester_level',
////                        'subject_code' => '$subject_code',
//                        'subject_name' => '$subject_name',
//                    ],
//                ],
//            ],
//        ]);
//
//        collect(iterator_to_array($subjects))
//            ->pluck('_id')
//            ->groupBy(['subject_name', 'student_degree_followed'])
//            ->all();

        return $next($collection);
    }
}
