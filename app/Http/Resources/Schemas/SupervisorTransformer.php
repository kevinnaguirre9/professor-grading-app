<?php

namespace App\Http\Resources\Schemas;

use League\Fractal\TransformerAbstract as Transformer;
use ProfessorGradingApp\Domain\Supervisor\Supervisor;

/**
 * Class SupervisorTransformer
 *
 * @package App\Http\Resources\Schemas
 */
final class SupervisorTransformer extends Transformer
{
    /**
     * @param Supervisor $Supervisor
     * @return array
     */
    public function transform(Supervisor $Supervisor): array
    {
        return array_merge(
            ['id' => $Supervisor->id()],
            $Supervisor->toPrimitives(),
            $this->getLinks($Supervisor)
        );
    }

    /**
     * @param Supervisor $Supervisor
     * @return array
     */
    public function getLinks(Supervisor $Supervisor) : array
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
        return 'supervisors';
    }
}
