<?php

use App\Http\Resources\Schemas\StudentTransformer;
use App\Http\Resources\Schemas\SubjectTransformer;
use App\Http\Resources\Schemas\TutorshipSchema;
use ProfessorGradingApp\Domain\Student\Student;
use ProfessorGradingApp\Domain\Subject\Subject;
use ProfessorGradingApp\Domain\Tutorship\Tutorship;

return [

    /*
    |--------------------------------------------------------------------------
    | API Schemas
    |--------------------------------------------------------------------------
    |
    | This file stores the configurations between Entities and its Schemas
    | to generate JSON:API Resources
    |
    */

    Tutorship::class => TutorshipSchema::class,
    Student::class => StudentTransformer::class,
    Subject::class => SubjectTransformer::class,
];
