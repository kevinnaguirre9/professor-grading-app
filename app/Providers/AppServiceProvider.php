<?php

namespace App\Providers;

use Doctrine\ODM\MongoDB\DocumentManager;
use Illuminate\Support\ServiceProvider;
use ProfessorGradingApp\Domain\AcademicPeriod\Repositories\AcademicPeriodRepository;
use ProfessorGradingApp\Domain\Student\Repositories\StudentRepository;
use ProfessorGradingApp\Domain\User\Contracts\PasswordHashingManager;
use ProfessorGradingApp\Domain\User\Repositories\UserRepository;
use ProfessorGradingApp\Infrastructure\AcademicPeriod\Repositories\MongoDbAcademicPeriodRepository;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Factories\DocumentManagerFactory;
use ProfessorGradingApp\Infrastructure\Student\Repositories\MongoDbStudentRepository;
use ProfessorGradingApp\Infrastructure\User\Repositories\MongoDbUserRepository;
use ProfessorGradingApp\Infrastructure\User\Services\BcryptPasswordHashingManager;

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
    public function register(): void
    {
        $this->app->singleton(DocumentManager::class, fn() => DocumentManagerFactory::create());

        $this->app->bind(AcademicPeriodRepository::class, MongoDbAcademicPeriodRepository::class);

        $this->app->bind(StudentRepository::class, MongoDbStudentRepository::class);

        $this->app->bind(UserRepository::class, MongoDbUserRepository::class);

        $this->app->bind(
            PasswordHashingManager::class,
            fn($app) => new BcryptPasswordHashingManager($app['config']['hashing.bcrypt'] ?? [])
        );
    }
}
