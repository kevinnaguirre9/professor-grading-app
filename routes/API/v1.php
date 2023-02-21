<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\AcademicPeriod\AcademicPeriodPostController;

$router->get('/', function () use ($router) {
    return response()->json($router->app->version());
});


$router->post('/academic-periods', AcademicPeriodPostController::class);
