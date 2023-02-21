<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Common\Exceptions;

/**
 * Class InvalidWeekdayValue
 *
 * @package ProfessorGradingApp\Domain\Common\Exceptions
 */
final class InvalidWeekdayValue extends AbstractCoreException
{
    protected const ERROR_TYPE = 'invalid_weekday_value';

    private string $errorDetail;

    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->errorDetail = sprintf(
            "Invalid weekday value <%s>. Possible values are from 1 to 7 for Monday to Sunday respectively.",
            $value
        );

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Cannot create Weekday.';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
