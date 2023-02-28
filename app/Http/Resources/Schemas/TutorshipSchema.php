<?php

namespace App\Http\Resources\Schemas;

use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract as Transformer;
use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;
use ProfessorGradingApp\Domain\Student\Exceptions\StudentNotFound;
use ProfessorGradingApp\Domain\Student\Services\StudentFinder;
use ProfessorGradingApp\Domain\Tutorship\Tutorship;

/**
 * Class TutorshipSchema
 *
 * @package App\Http\Resources\Schemas
 */
final class TutorshipSchema extends Transformer
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'advisor',
//        'subject',
    ];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'advisor',
//        'subject',
    ];

    /**
     * @param Tutorship $Tutorship
     * @return array
     */
    public function transform(Tutorship $Tutorship): array
    {
        $data = collect($Tutorship->toPrimitives())
            ->except(['advisor_id', 'subject_id'])
            ->toArray();

        return array_merge(
            ['id' => $Tutorship->id()],
            $data,
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

    /**
     * Include Advisor
     *
     * @param Tutorship $Tutorship
     * @return Item
     * @throws InvalidUuid
     * @throws StudentNotFound
     */
    public function includeAdvisor(Tutorship $Tutorship): Item
    {
        $advisorId = $Tutorship->advisorId();

        /** @var StudentFinder $studentFinder */
        $studentFinder = app(StudentFinder::class);

        $Student = $studentFinder->__invoke(
            new StudentId($advisorId)
        );

        return $this->item($Student, new StudentTransformer);
    }

//    /**
//     * Include Subject
//     */
//    public function includeSubject(Tutorship $Tutorship): Item
//    {
//        return $this->item([], new SubjectTransformer);
//    }
}
