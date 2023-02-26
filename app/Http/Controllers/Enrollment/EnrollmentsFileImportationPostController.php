<?php

namespace App\Http\Controllers\Enrollment;

use App\Http\Controllers\Controller;
use App\Jobs\CreateEnrollmentsFromFile;
use Illuminate\Http\{JsonResponse, Request};
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EnrollmentsFileImportationPostController
 *
 * @package App\Http\Controllers\Enrollment
 */
final class EnrollmentsFileImportationPostController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        dispatch(new CreateEnrollmentsFromFile());

        return response()->json([
            'message' => 'Enrollments are being created from file...'
        ], Response::HTTP_ACCEPTED);
    }
}
