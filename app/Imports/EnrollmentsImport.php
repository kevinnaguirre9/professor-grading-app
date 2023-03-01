<?php

namespace App\Imports;

use App\Model\StudentClassEnrollment;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

/**
 * Class EnrollmentsImport
 *
 * @package App\Imports
 */
final class EnrollmentsImport implements ToModel, WithChunkReading
{
    use RemembersRowNumber;

    /**
     * @inheritdoc
     */
    public function model(array $row)
    {
        return new StudentClassEnrollment([
            'headquarter' => $row[0],
            'campus' => $row[1],
            'degree' => $row[3],
            'academic_period' => $row[4],
            'national_identification_number' => $row[5],
            'student_full_name' => $row[6],
            'semester_level' => $row[7],
            'subject_code' => $row[8],
            'subject_name' => $row[9],
            'class_group' => $row[10],
//            'final_grade' => $row[12],
            'professor_full_name' => $row[14],
            'weekday_number' => $row[15],
//            'weekday_name',
            'start_class_time' => $row[17],
            'end_class_time' => $row[18],
            'student_personal_email' => $row[19],
            'student_institutional_email' => $row[20],
            'student_mobile_phone' => $row[21],
            'student_landline_phone' => $row[22],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function chunkSize(): int
    {
        return 100;
    }
}
