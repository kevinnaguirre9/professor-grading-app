<?php

namespace App\Providers;

use Doctrine\ODM\MongoDB\DocumentManager;
use Illuminate\Support\ServiceProvider;
use ProfessorGradingApp\Domain\AcademicPeriod\Repositories\AcademicPeriodRepository;
use ProfessorGradingApp\Domain\CourseClass\Repositories\CourseClassRepository;
use ProfessorGradingApp\Domain\Degree\Repositories\DegreeRepository;
use ProfessorGradingApp\Domain\Enrollment\Repositories\EnrollmentRepository;
use ProfessorGradingApp\Domain\Grade\Repositories\GradeRepository;
use ProfessorGradingApp\Domain\Student\Repositories\StudentRepository;
use ProfessorGradingApp\Domain\Subject\Repositories\SubjectRepository;
use ProfessorGradingApp\Domain\Tutorship\Repositories\TutorshipRepository;
use ProfessorGradingApp\Domain\User\Contracts\PasswordHashingManager;
use ProfessorGradingApp\Domain\User\Repositories\UserRepository;
use ProfessorGradingApp\Infrastructure\AcademicPeriod\Repositories\MongoDbAcademicPeriodRepository;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Factories\DocumentManagerFactory;
use ProfessorGradingApp\Infrastructure\CourseClass\Repositories\MongoDbCourseClassRepository;
use ProfessorGradingApp\Infrastructure\Degree\Repositories\MongoDbDegreeRepository;
use ProfessorGradingApp\Infrastructure\Enrollment\Repositories\MongoDbEnrollmentRepository;
use ProfessorGradingApp\Infrastructure\Grade\Repositories\MongoDbGradeRepository;
use ProfessorGradingApp\Infrastructure\Student\Repositories\MongoDbStudentRepository;
use ProfessorGradingApp\Infrastructure\Subject\Repositories\MongoDbSubjectRepository;
use ProfessorGradingApp\Infrastructure\Tutorship\Repositories\MongoDbTutorshipRepository;
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

        $this->app->bind(EnrollmentRepository::class, MongoDbEnrollmentRepository::class);

        $this->app->bind(DegreeRepository::class, MongoDbDegreeRepository::class);

        $this->app->bind(SubjectRepository::class, MongoDbSubjectRepository::class);

        $this->app->bind(CourseClassRepository::class, MongoDbCourseClassRepository::class);

        $this->app->bind(GradeRepository::class, MongoDbGradeRepository::class);

        $this->app->bind(TutorshipRepository::class, MongoDbTutorshipRepository::class);
    }
}
