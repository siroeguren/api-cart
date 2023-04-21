<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Services;

use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

class HandlerEventDispatcher
{
    //////ESTO ES UNA PRUEBA DE CAMBIUO DE BRANCH //////////
    public function __construct(
        private readonly MessageBusInterface $queryBus,
        private readonly MessageBusInterface $commandBus
    )
    {
    }

    public function dispatchCommand($event): array
    {
        return $this->dispatch($event, $this->commandBus);
    }

    public function dispatchQuery($event): array
    {
        return $this->dispatch($event, $this->queryBus);
    }

    private function dispatch(mixed $event, MessageBusInterface $bus): array
    {
        try {
            $envelope = $bus->dispatch($event);

        } catch (HandlerFailedException $e) {
            $this->processBusException($e);
        }
        return $this->processEnvelope($envelope);
    }

    private function processEnvelope($envelope): array
    {
        $handledStamps = $envelope->last(HandledStamp::class);
        $data = $handledStamps->getResult();

        return (is_array($data)) ? $data : (array)$data;
    }

    /**
     * @throws Throwable
     */
    private function processBusException(HandlerFailedException $e): void
    {
        while ($e instanceof HandlerFailedException) {
            /** @var Throwable $e */
            $e = $e->getPrevious();
        }
        throw $e;
    }
}