<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Validation\ValidationException;
use ProfessorGradingApp\Application\Student\Register\RegisterStudentCommand;
use ProfessorGradingApp\Application\User\Register\CreateUserCommand;
use ProfessorGradingApp\Domain\Student\Student;
use ProfessorGradingApp\Domain\User\User;
use ProfessorGradingApp\Domain\User\ValueObjects\Role;

/**
 * Class StudentPostController
 *
 * @package App\Http\Controllers\Student
 */
final class StudentPostController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, $this->rules());

        $createUserCommand = new CreateUserCommand(
            $request->input('institutional_email'),
            $request->input( 'identification_card'),
            Role::STUDENT->value()
        );

        /** @var User $User */
        $User = $this->handleCommand($createUserCommand);

        $registerStudentCommand = new RegisterStudentCommand(
            fullName: $request->input('full_name'),
            institutionalEmail: $request->input('institutional_email'),
            personalEmail: $request->input('personal_email'),
            nationalIdentificationNumber: $request->input('identification_card'),
            userId: (string) $User->id(),
            mobileNumber: $request->input('mobile_number'),
            landlineNumber: $request->input('landline_number'),
        );

        /** @var Student $Student */
        $Student = $this->handleCommand($registerStudentCommand);

        return response()->json([
            'message' => 'Student created successfully',
        ], 201);
    }

    /**
     * @return string[]
     */
    private function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'institutional_email' => 'required|string',
            'personal_email' => 'required|string',
            'identification_card' => 'required|string',
            'mobile_number' => 'required|string',
            'landline_number' => 'required|string',
        ];
    }
}
