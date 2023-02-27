<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\AcademicPeriod\AcademicPeriodPostController;

$router->get('/', function () use ($router) {
    return response()->json($router->app->version());
});

$router->post('/auth/sign-in', [
    'uses' => 'Auth\AuthSignInPostController',
    'as' => 'auth.sign-in.post'
]);

$router->get('/account', [
    'uses' => 'Auth\AccountGetController',
    'as' => 'account.get'
]);

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

$router->post('/grades', [
    'uses' => 'Grade\GradePostController',
    'as' => 'grades.post'
]);

$router->post('/tutorships', [
    'uses' => 'Tutorship\TutorshipPostController',
    'as' => 'tutorships.post'
]);
