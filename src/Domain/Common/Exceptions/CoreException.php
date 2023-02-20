<?php

namespace ProfessorGradingApp\Domain\Common\Exceptions;

/**
 * Interface CoreException
 *
 * @package ProfessorGradingApp\Domain\Common\Exceptions
 */
interface CoreException
{
    /**
     * Key/constant to identify the exception
     *
     * @return string
     */
    public function type(): string;

    /**
     * General error message title
     *
     * @return string
     */
    public function title(): string;

    /**
     * Error details
     *
     * @return string
     */
    public function detail(): string;
}
