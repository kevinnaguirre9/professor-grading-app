<?php

namespace App\Http\Resources\Schemas;

use League\Fractal\TransformerAbstract as Transformer;
use ProfessorGradingApp\Domain\Subject\Subject;

/**
 * Class SubjectTransformer
 *
 * @package App\Http\Resources\Schemas
 */
final class SubjectTransformer extends Transformer
{
    /**
     * @param Subject $Subject
     * @return array
     */
    public function transform(Subject $Subject): array
    {
        return array_merge(
            ['id' => $Subject->id()],
            $Subject->toPrimitives(),
            $this->getLinks($Subject)
        );
    }

    /**
     * @param Subject $Subject
     * @return array
     */
    public function getLinks(Subject $Subject) : array
    {
        $data['_links'] = [
            'self' => [
            ],
        ];

        return $data;
    }
}
