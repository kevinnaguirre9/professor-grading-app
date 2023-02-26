<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResourceManager;
use Laravel\Lumen\Routing\Controller as BaseController;
use League\Tactician\CommandBus;
use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command;
use Symfony\Component\HttpFoundation\Response;

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
    protected function handleCommand(Command $command): mixed
    {
        return $this->commandBus->handle($command);
    }

    /**
     * Create a Response using the Resources Factory
     *
     * @param $resource
     * @param integer $code
     * @return Response
     */
    protected function createResponse($resource, int $code = Response::HTTP_OK): Response
    {
        return ResourceManager::createResponse(
            $resource,
            $code
        );
    }
}
