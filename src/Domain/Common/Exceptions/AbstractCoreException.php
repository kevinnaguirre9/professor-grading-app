<?php

namespace ProfessorGradingApp\Domain\Common\Exceptions;

/**
 * Class AbstractCoreException
 *
 * @package ProfessorGradingApp\Domain\Common\Exceptions
 */
abstract class AbstractCoreException extends \Exception implements CoreException
{
    /**
     * The error type, could be a constant or a key
     */
    protected const ERROR_TYPE = 'error_type';

    /**
     *
     */
    public function __construct()
    {
        $errorMessage = sprintf("%s %s", $this->title(), $this->detail());

        parent::__construct($errorMessage);
    }

    /**
     * @inheritDoc
     */
    public function type(): string
    {
        return self::ERROR_TYPE;
    }
}
