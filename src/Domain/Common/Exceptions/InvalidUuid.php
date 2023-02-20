<?php

namespace ProfessorGradingApp\Domain\Common\Exceptions;

/**
 * Class InvalidUuid
 *
 * @package ProfessorGradingApp\Domain\Common\Exceptions
 */
final class InvalidUuid extends AbstractCoreException
{
    protected const ERROR_TYPE = 'invalid_uuid';

    private string $errorDetail;

    /**
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->errorDetail = "The provided UUID <$uuid> is not valid.";

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Invalid UUID';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
