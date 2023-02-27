<?php

namespace ProfessorGradingApp\Domain\Common\Exceptions;

/**
 * Class EmptyFilters
 *
 * @package ProfessorGradingApp\Domain\Common\Exceptions
 */
final class EmptyFilters extends AbstractCoreException
{
    protected const ERROR_TYPE = 'empty_filters';

    /**
     * @inheritdoc
     */
    public function title(): string
    {
        return 'Empty filters.';
    }

    /**
     * @inheritdoc
     */
    public function detail(): string
    {
        return 'You must provide at least one filter to search the records.';
    }
}
