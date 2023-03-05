<?php

namespace App\Imports;

use ProfessorGradingApp\Infrastructure\Common\Concerns\InteractsWithDatabaseCollection;
use Psr\Log\LoggerInterface;
use Spatie\SimpleExcel\SimpleExcelReader;

/**
 * Class EnrollmentsBibleRecordsImporter
 *
 * @package App\Imports
 */
final class EnrollmentsBibleRecordsImporter
{
    use InteractsWithDatabaseCollection;

    private const COLLECTION_NAME = 'enrollments_bible';

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(private readonly LoggerInterface $logger)
    {
        $this->selectCollection(self::COLLECTION_NAME);
    }

    /**
     * Register enrollments bible from file to database
     *
     * @param string $fileLocation
     * @return void
     */
    public function __invoke(string $fileLocation): void
    {
        try {
            $rows = SimpleExcelReader::create($fileLocation)
                ->useHeaders($this->customHeaders())
                ->getRows();

            $rows->each($this->enrollmentsBibleRegistrar());

        } catch (\Exception $e) {

            $this->logger->error(
                sprintf('Rolling back. Importation process has errors: %s ', $e->getMessage())
            );

            $this->collection->drop();
        }
    }

    /**
     * @return \Closure
     */
    private function enrollmentsBibleRegistrar(): \Closure
    {
        return function (array $rowProperties) {
            $this->collection->insertOne($rowProperties);
        };
    }

    /**
     * @return string[]
     */
    private function customHeaders(): array
    {
        return [
            'headquarter',
            'campus',
            'subject_degree_taken',
            'student_degree_followed',
            'academic_period',
            'national_identification_number',
            'student_full_name',
            'semester_level',
            'subject_code',
            'subject_name',
            'class_group_number',
            'class_group',
            'final_grade',
            'times',
            'professor_full_name',
            'weekday_number',
            'weekday_name',
            'start_class_time',
            'end_class_time',
            'student_personal_email',
            'student_institutional_email',
            'student_mobile_phone',
            'student_landline_phone',
        ];
    }
}
