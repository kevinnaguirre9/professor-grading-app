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
     * The custom type name to be used in the mapping.
     *
     * @return string
     */
    public static function customTypeName(): string;

    /**
     * The custom type FQCN.
     *
     * @return string
     */
    public function customTypeClassName() : string;
}
