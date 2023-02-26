<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AccountGetController
 *
 * @package App\Http\Controllers\Auth
 */
final class AccountGetController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        /** @var GenericUser $User */
        $User = auth()->user();

        //TODO: use schemas for sending Student or Supervisor information along with their resources links
        return response()->json(
            [
                'user' => [
                    'id'        => $User->id,
                    'name'      => $User->name,
                    'email'     => $User->email,
                ],
            ],
            Response::HTTP_OK
        );
    }
}
