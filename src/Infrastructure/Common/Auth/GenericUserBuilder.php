<?php

namespace ProfessorGradingApp\Infrastructure\Common\Auth;

use Illuminate\Auth\GenericUser;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;
use ProfessorGradingApp\Domain\Student\Repositories\StudentRepository;
use ProfessorGradingApp\Domain\Supervisor\Repositories\SupervisorRepository;
use ProfessorGradingApp\Domain\Supervisor\ValueObjects\SupervisorId;
use ProfessorGradingApp\Domain\User\User;
use ProfessorGradingApp\Domain\User\ValueObjects\Role;

/**
 * Class GenericUserBuilder
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Auth
 */
final class GenericUserBuilder
{
    /**
     * @param StudentRepository $studentRepository
     * @param SupervisorRepository $supervisorRepository
     */
    public function __construct(
        private readonly StudentRepository $studentRepository,
        private readonly SupervisorRepository $supervisorRepository,
    ) {
    }

    /**
     * @param User $User
     * @return GenericUser
     * @throws InvalidUuid
     */
    public function __invoke(User $User): GenericUser
    {
        $authenticatableId = $User->authenticatableId();

        $Authenticatable = match ($User->role()) {
            Role::STUDENT => $this->studentRepository->find(
                new StudentId($authenticatableId)
            ),
            Role::SUPERVISOR => $this->supervisorRepository->find(
                new SupervisorId($authenticatableId)
            ),
        };

        $basicUserInfo = [
            'id' => (string) $User->id(),
            'full_name' => $User->fullName(),
            'email' => (string) $User->email(),
        ];

        return new GenericUser(
            array_merge($basicUserInfo, ['authenticatable' => $Authenticatable])
        );
    }
}
