<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use ProfessorGradingApp\Application\User\Authenticate\AuthenticateUserCommand;
use ProfessorGradingApp\Application\User\Authenticate\AuthenticationResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthSignInPostController
 *
 * @package App\Http\Controllers\Auth
 */
final class AuthSignInPostController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, $this->rules());

        $command = new AuthenticateUserCommand(
            $request->input('email'),
            $request->input('password'),
        );

        /** @var AuthenticationResponse $authenticationResponse */
        $jwtResponse = $this->handleCommand($command);

        return response()->json([
            'token' => $jwtResponse->token(),
        ], Response::HTTP_OK);
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}
