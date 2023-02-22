<?php

namespace ProfessorGradingApp\Domain\Grade\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;
use ProfessorGradingApp\Domain\Grade\ValueObjects\Rating;

/**
 * Class InvalidRating
 *
 * @package ProfessorGradingApp\Domain\Grade\Exceptions
 */
final class InvalidRating extends AbstractCoreException
{
    protected const ERROR_TYPE = 'invalid_rating';

    private string $errorDetail;

    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->errorDetail = sprintf("Rating value <%s> is not valid. Available values are: %s",
            $value,
            implode(', ', Rating::allValues())
        );

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Invalid Rating.';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
