<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\CommandBus;
use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command;

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
     * @param Command $command
     * @return void
     */
    public function handleCommand(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
