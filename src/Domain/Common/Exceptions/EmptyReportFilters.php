<?php

namespace ProfessorGradingApp\Domain\Common\Exceptions;

/**
 * Class EmptyReportFilters
 *
 * @package ProfessorGradingApp\Domain\Common\Exceptions
 */
final class EmptyReportFilters extends AbstractCoreException
{
    protected const ERROR_TYPE = 'empty_report_filters';

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Empty report filters';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return 'Filters must be provided to perform a search';
    }
}
