<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class StudentClassEnrollment
 *
 * @package App\Model
 */
final class StudentClassEnrollment extends Model
{
    protected $collection = 'students_class_enrollments';

    protected $connection = 'mongodb';

    protected $fillable = [
        'headquarter',
        'campus',
        'degree',
        'academic_period',
        'national_identification_number',
        'student_full_name',
        'semester_level',
        'subject_code',
        'subject_name',
        'class_group',
//        'final_grade',
        'professor_full_name',
        'weekday_number',
//        'weekday_name',
        'start_class_time',
        'end_class_time',
        'student_personal_email',
        'student_institutional_email',
        'student_mobile_phone',
        'student_landline_phone',
    ];
}
