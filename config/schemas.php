<?php

use App\Http\Resources\Schemas\TutorshipSchema;
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

];
