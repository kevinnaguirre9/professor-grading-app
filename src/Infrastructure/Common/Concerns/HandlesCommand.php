<?php

namespace ProfessorGradingApp\Infrastructure\Common\Concerns;

use League\Tactician\CommandBus;

/**
 * Trait HandlesCommand
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Concerns
 */
trait HandlesCommand
{
    /**
     * @param $command
     * @return void
     */
    public function handleCommand($command): void
    {
        /** @var CommandBus $commandBus */
        $commandBus = app('League\Tactician\CommandBus');

        $commandBus->handle($command);
    }
}
