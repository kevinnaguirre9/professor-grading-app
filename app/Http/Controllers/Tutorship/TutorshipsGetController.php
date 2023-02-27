<?php

namespace App\Http\Controllers\Tutorship;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProfessorGradingApp\Application\Tutorship\Search\SearchTutorshipsCommand;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TutorshipsGetController
 *
 * @package App\Http\Controllers\Tutorship
 */
final class TutorshipsGetController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $command = new SearchTutorshipsCommand(
            $request->query('filters') ?? [],
            $request->query('page'),
            $request->query('limit'),
        );

        $tutorships = $this->handleCommand($command);

        return $this->createResponse($tutorships);
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'filters' => 'array',
            'page' => 'int',
            'limit' => 'int',
        ];
    }
}
