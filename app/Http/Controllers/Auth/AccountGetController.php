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
     * @return Response
     */
    public function __invoke(): Response
    {
        /** @var GenericUser $User */
        $User = auth()->user();

        return $this->createResponse($User);
    }
}
