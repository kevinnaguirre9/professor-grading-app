<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\AcademicPeriod\AcademicPeriodPostController;

$router->get('/', function () use ($router) {
    return response()->json($router->app->version());
});


$router->post('/academic-periods', [
    'uses' => 'AcademicPeriod\AcademicPeriodPostController',
    'as' => 'academic-periods.post'
]);

$router->post('/students', [
    'uses' => 'Student\StudentPostController',
    'as' => 'students.post'
]);

$router->post('/enrollments/files', [
    'uses' => 'Enrollment\EnrollmentsFileImportationPostController',
    'as' => 'enrollments.files.post'
]);
