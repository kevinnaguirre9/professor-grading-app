<?php

namespace App\Http\Resources\Schemas;

use League\Fractal\TransformerAbstract as Transformer;
use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Tutorship\Tutorship;

/**
 * Class TutorshipSchema
 *
 * @package App\Http\Resources\Schemas
 */
final class TutorshipSchema extends Transformer
{
    /**
     * @param Tutorship $Tutorship
     * @return array
     */
    public function transform(Tutorship $Tutorship): array
    {
        return array_merge(
            ['id' => $Tutorship->id()],
            $Tutorship->toPrimitives(),
            $this->getLinks($Tutorship)
        );
    }

    /**
     * @param BaseEntity $Tutorship
     * @return array
     */
    public function getLinks(BaseEntity $Tutorship) : array
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
        return 'tutorships';
    }
}
