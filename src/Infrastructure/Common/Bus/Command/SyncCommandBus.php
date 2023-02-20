<?php

namespace ProfessorGradingApp\Infrastructure\Common\Bus\Command;

use League\Tactician\CommandBus as TacticianCommandBus;
use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command;
use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\CommandBus as CommandBusContract;

/**
 * Class SyncCommandBus
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Bus\Command
 */
final class SyncCommandBus implements CommandBusContract
{
    /**
     * @param TacticianCommandBus $commandBus
     */
    public function __construct(private TacticianCommandBus $commandBus)
    {
    }

    /**
     * @param Command $command
     * @return void
     */
    public function dispatch(Command $command): void
    {
        $this->commandBus->handle($command);
    }
}
