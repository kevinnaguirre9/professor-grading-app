<?php

namespace App\Jobs;

use App\Imports\EnrollmentsImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class CreateEnrollmentsFromFile
 *
 * @package App\Jobs
 */
final class CreateEnrollmentsFromFile extends Job
{
    /**
     * @param string $enrollmentsFilePath
     */
    public function __construct(private readonly string $enrollmentsFilePath)
    {
    }

    public function __invoke(): void
    {
        Excel::import(new EnrollmentsImport, Storage::path($this->enrollmentsFilePath));

        //TODO: send email to user

        //Deletes file
//        Storage::delete($this->enrollmentsFilePath);
    }
}
