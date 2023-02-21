<?php

namespace App\Providers;

use Doctrine\ODM\MongoDB\DocumentManager;
use Illuminate\Support\ServiceProvider;
use ProfessorGradingApp\Domain\AcademicPeriod\Repositories\AcademicPeriodRepository;
use ProfessorGradingApp\Domain\Student\Repositories\StudentRepository;
use ProfessorGradingApp\Infrastructure\AcademicPeriod\Repositories\MongoDbAcademicPeriodRepository;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Factories\DocumentManagerFactory;
use ProfessorGradingApp\Infrastructure\Student\Repositories\MongoDbStudentRepository;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DocumentManager::class, fn() => DocumentManagerFactory::create());

        $this->app->bind(AcademicPeriodRepository::class, MongoDbAcademicPeriodRepository::class);

        $this->app->bind(StudentRepository::class, MongoDbStudentRepository::class);
    }
}
