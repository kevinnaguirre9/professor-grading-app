<?php

namespace App\Processors\Concerns;

use League\Tactician\CommandBus;
use ProfessorGradingApp\Domain\Common\Events\Event;
use Psr\Log\LoggerInterface;

/**
 * Trait ProcessesMessage
 *
 * @package App\Processors\Concerns
 */
trait ProcessesMessage
{
    /**
     * @param LoggerInterface $logger
     * @param CommandBus $commandBus
     */
    public function __construct(
        protected readonly LoggerInterface $logger,
        protected readonly CommandBus $commandBus,
    ) {
    }

    /**
     * @param Event $message
     * @return array
     */
    protected function getMessagePayload(Event $message): array
    {
        return $message->jsonSerialize();
    }
}
