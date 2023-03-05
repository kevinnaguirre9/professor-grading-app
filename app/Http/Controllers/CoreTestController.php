<?php

namespace App\Http\Controllers;

use App\Events\EnrollmentsBibleRecordsRegistered;
use Illuminate\Http\JsonResponse;

/**
 * Class CoreTestController
 *
 * @package App\Http\Controllers
 */
final class CoreTestController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        event(new EnrollmentsBibleRecordsRegistered);

        return response()->json(['message' => 'OK']);
    }
}
