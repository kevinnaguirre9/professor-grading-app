<?php

namespace App\Http\Resources\Schemas;

use Illuminate\Auth\GenericUser;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract as Transformer;
use ProfessorGradingApp\Domain\Student\Student;

/**
 * Class GenericUserTransformer
 *
 * @package App\Http\Resources\Schemas
 */
final class GenericUserTransformer extends Transformer
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'authenticatable',
    ];

    /**
     * @param GenericUser $GenericUser
     *
     * @return array
     */
    public function transform(GenericUser $GenericUser): array
    {
        return array_merge(
            [
                'id' => $GenericUser->id,
                'full_name' => $GenericUser->full_name,
                'email' => $GenericUser->email
            ],
            $this->getLinks($GenericUser),
        );
    }

    /**
     * @param GenericUser $GenericUser
     * @return array
     */
    public function getLinks(GenericUser $GenericUser) : array
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
        return 'users';
    }

    /**
     * @param GenericUser $GenericUser
     * @return Item
     */
    public function includeAuthenticatable(GenericUser $GenericUser) : Item
    {
        $transformer = $GenericUser->authenticatable instanceof Student
            ? new StudentTransformer()
            : new SupervisorTransformer();

        return $this->item($GenericUser->authenticatable, $transformer);
    }
}
