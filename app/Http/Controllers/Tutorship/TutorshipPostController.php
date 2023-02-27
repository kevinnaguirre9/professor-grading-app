<?php

namespace App\Http\Controllers\Tutorship;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use ProfessorGradingApp\Application\Tutorship\Register\RegisterTutorshipCommand;

/**
 * Class TutorshipPostController
 *
 * @package App\Http\Controllers\Tutorship
 */
final class TutorshipPostController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, $this->rules());

        $command = new RegisterTutorshipCommand(
            $request->input('advisor_id'),
            $request->input('subject_id'),
        );

        $this->handleCommand($command);

        return response()->json([
            'message' => 'Tutorship registered successfully',
        ], 201);
    }

    /**
     * @return string[]
     */
    private function rules(): array
    {
        return [
            'advisor_id' => 'required|string',
            'subject_id' => 'required|string',
        ];
    }
}
