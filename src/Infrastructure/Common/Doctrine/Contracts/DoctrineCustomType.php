<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts;

/**
 * Interface DoctrineCustomType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts
 */
interface DoctrineCustomType
{
    /**
     * @return string
     */
    public static function customTypeName(): string;
}
