<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use League\Tactician\CommandBus;
use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command;

/**
 * Class Controller
 *
 * @package App\Http\Controllers
 */
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
     * @return mixed
     */
    public function handleCommand(Command $command)
    {
        return $this->commandBus->handle($command);
    }
}
