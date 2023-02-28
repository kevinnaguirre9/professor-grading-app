<?php

namespace App\Http\Resources\Schemas;

use League\Fractal\TransformerAbstract as Transformer;
use ProfessorGradingApp\Domain\Student\Student;

/**
 * Class StudentTransformer
 *
 * @package App\Http\Resources\Schemas
 */
final class StudentTransformer extends Transformer
{
    /**
     * @param Student $Student
     * @return array
     */
    public function transform(Student $Student): array
    {
        return array_merge(
            ['id' => $Student->id()],
            $Student->toPrimitives(),
            $this->getLinks($Student)
        );
    }

    /**
     * @param Student $Student
     * @return array
     */
    public function getLinks(Student $Student) : array
    {
        $data['_links'] = [
            'self' => [
            ],
        ];

        return $data;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return 'students';
    }
}
