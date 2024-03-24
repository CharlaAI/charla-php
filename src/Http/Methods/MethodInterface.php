<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Http\Methods;

use CharlaAI\Charla\Transport\DefaultTransport;
use CharlaAI\Charla\Transport\TransportInterface;

/**
 * Interface MethodInterface
 *
 * This interface defines a contract for HTTP methods.
 * Any class implementing this interface should provide a constructor that accepts a DefaultTransport object.
 */
interface MethodInterface
{
    /**
     * MethodInterface constructor.
     *
     * @param TransportInterface $transport the transport to be used for the HTTP methods
     */
    public function __construct(TransportInterface $transport);
}
