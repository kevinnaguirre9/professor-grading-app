<?php

namespace ProfessorGradingApp\Domain\User\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;
use ProfessorGradingApp\Domain\User\ValueObjects\Role;

/**
 * Class InvalidRole
 *
 * @package ProfessorGradingApp\Domain\User\Exceptions
 */
final class InvalidRole extends AbstractCoreException
{
    protected const ERROR_TYPE = 'invalid_role';

    private string $errorDetail;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->errorDetail = sprintf(
            "Invalid role value: %s. Possible values are <%s>.",
            $value,
            implode(', ', Role::allValues())
        );

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Invalid Role.';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
