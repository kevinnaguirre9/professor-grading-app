<?php

namespace App\Http\Controllers\Grade;

use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Validation\ValidationException;
use ProfessorGradingApp\Application\Grade\Register\RegisterGradeCommand;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GradePostController
 *
 * @package App\Http\Controllers\Grade
 */
final class GradePostController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, $this->rules());

        $command = new RegisterGradeCommand(
            $request->input("class_id"),
            $request->input("student_id"), //TODO: get student id from token
            $request->input("rating"),
            $request->input("comment")
        );

        $this->handleCommand($command);

        return response()->json([
            "message" => "Grade registered successfully"
        ], Response::HTTP_CREATED);
    }

    /**
     * @return string[]
     */
    private function rules()
    {
        return [
            "class_id" => "required|string",
            "rating" => "required|integer",
            "comment" => "required|string",
        ];
    }
}
