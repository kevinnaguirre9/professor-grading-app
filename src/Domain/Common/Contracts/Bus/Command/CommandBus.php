<?php

namespace ProfessorGradingApp\Domain\Common\Contracts\Bus\Command;

/**
 * Interface CommandBus
 *
 * @package ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command
 */
interface CommandBus
{
    /**
     * @param Command $command
     * @return void
     */
    public function dispatch(Command $command) : void;
}
