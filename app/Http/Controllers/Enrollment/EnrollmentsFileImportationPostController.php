<?php

namespace App\Http\Controllers\Enrollment;

use App\Http\Controllers\Controller;
use App\Jobs\CreateEnrollmentsFromFile;
use Illuminate\Validation\ValidationException;
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
     * Path to store the file
     */
    const BASE_PATH = 'enrollments';

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws \Exception
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, $this->rules());

        $enrollmentsFilePath = $this->storeFile();

        dispatch(new CreateEnrollmentsFromFile($enrollmentsFilePath));

        return response()->json([
            'message' => 'Enrollments are being created from file...'
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function storeFile(): string
    {
        try {
            $enrollmentsFile = request()->file('enrollments_file');

            $enrollmentsFilePath = self::BASE_PATH . DIRECTORY_SEPARATOR . $enrollmentsFile->hashName();

            $enrollmentsFile->storeAs(self::BASE_PATH, $enrollmentsFile->hashName());

            return $enrollmentsFilePath;

        } catch (\Exception $e) {

            throw new \Exception('Error storing file: ' . $e->getMessage());
        }
    }

    /**
     * @return string[]
     */
    private function rules(): array
    {
        return [
            'enrollments_file' => 'required|file|mimes:xlsx|max:50000',
        ];
    }
}
