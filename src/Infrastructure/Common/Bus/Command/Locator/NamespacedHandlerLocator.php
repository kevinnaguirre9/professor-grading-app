<?php

namespace ProfessorGradingApp\Infrastructure\Common\Bus\Command\Locator;

use League\Tactician\Exception\MissingHandlerException;
use League\Tactician\Handler\Locator\HandlerLocator;
use Psr\Container\{ContainerExceptionInterface, ContainerInterface, NotFoundExceptionInterface};

/**
 * Class NamespacedHandlerLocator
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Bus\Command\Locator
 */
final class NamespacedHandlerLocator implements HandlerLocator
{
    /**
     * @param ContainerInterface $container
     */
    public function __construct(private ContainerInterface $container)
    {
    }

    /**
     * Retrieves the handler for a specified command
     *
     * @param $commandName
     *
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getHandlerForCommand($commandName): mixed
    {
        $commandHandler = $this->resolveHandlerForCommand($commandName);

        return $this->container->get($commandHandler);
    }

    /**
     * Resolve a Handler FQCN from a command FQCN.
     *
     * @param $commandName
     * @return string
     */
    private function resolveHandlerForCommand($commandName) : string
    {
        $handler = str_replace('Command', 'Handler', $commandName);

        if(!class_exists($handler))
            throw MissingHandlerException::forCommand($commandName);

        return $handler;
    }
}
