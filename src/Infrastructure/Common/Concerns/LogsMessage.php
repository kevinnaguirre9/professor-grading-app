<?php

namespace ProfessorGradingApp\Infrastructure\Common\Concerns;

use Psr\Log\LoggerInterface;

/**
 * Trait LogsMessage
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Concerns
 */
trait LogsMessage
{
    /**
     * @param string $message
     * @param string $type
     * @return void
     * @see LogLevel
     */
    public function log(string $message, string $type = 'info'): void
    {
        /** @var LoggerInterface $logger */
        $logger = app(LoggerInterface::class);

        $logger->log($type, $message);
    }
}
