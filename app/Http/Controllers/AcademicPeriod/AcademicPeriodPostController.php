<?php

namespace App\Http\Controllers\AcademicPeriod;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\{JsonResponse, Request};
use Symfony\Component\HttpFoundation\Response;
use ProfessorGradingApp\Application\AcademicPeriod\Register\RegisterAcademicPeriodCommand;

/**
 * Class AcademicPeriodPostController
 *
 * @package App\Http\Controllers\AcademicPeriod
 */
final class AcademicPeriodPostController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, $this->rules());

        $command = new RegisterAcademicPeriodCommand(
            $request->get('name'),
        );

        $this->handleCommand($command);

        return response()
            ->json(['message' => 'Academic period created successfully'], Response::HTTP_CREATED);
    }

    /**
     * @return string[]
     */
    private function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
