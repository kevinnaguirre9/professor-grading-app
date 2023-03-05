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
     * @return mixed
     */
    public function handleCommand($command): mixed
    {
        /** @var CommandBus $commandBus */
        $commandBus = app('League\Tactician\CommandBus');

        return $commandBus->handle($command);
    }
}
