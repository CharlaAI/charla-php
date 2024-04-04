<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Http;

use CharlaAI\Charla\Http\Methods\MethodInterface;
use CharlaAI\Charla\Transport\TransportInterface;
use RuntimeException;

/**
 * Class Client
 *
 * This class provides a method to call a specific HTTP method using a transport.
 */
class Client
{
    /**
     * Client constructor.
     *
     * @param TransportInterface $transport the transport to use for the HTTP methods
     */
    public function __construct(
        private TransportInterface $transport,
    ) {
    }

    /**
     * Call a specific HTTP method using the transport.
     *
     * @template T of MethodInterface
     *
     * @param class-string<T> $class the class of the HTTP method to call
     *
     * @return T the called HTTP method
     *
     * @throws RuntimeException if the class does not exist
     */
    public function call(string $class): MethodInterface
    {
        if (!class_exists($class)) {
            throw new RuntimeException("{$class} does not exist");
        }

        return new $class($this->transport);
    }
}
