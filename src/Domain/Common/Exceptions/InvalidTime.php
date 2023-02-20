<?php

namespace ProfessorGradingApp\Domain\Common\Exceptions;

/**
 * Class InvalidTime
 *
 * @package ProfessorGradingApp\Domain\Common\Exceptions
 */
final class InvalidTime extends AbstractCoreException
{
    protected const ERROR_TYPE = 'invalid_time';

    private string $errorDetail;

    /**
     * @param string $value The invalid time.
     */
    public function __construct(string $value)
    {
        $this->errorDetail = sprintf('"%s" is not a valid time. It must be in the format "HH:MM".', $value);

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Cannot create time';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
