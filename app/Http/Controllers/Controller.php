<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\CommandBus;

class Controller extends BaseController
{
    /**
     * @param CommandBus $commandBus
     */
    public function __construct(
        private readonly CommandBus $commandBus,
    ) {
    }

    /**
     * Dispatches a command to the command bus
     *
     * @param $command
     * @return void
     */
    public function handleCommand($command): void
    {
        $this->commandBus->dispatch($command);
    }
}
