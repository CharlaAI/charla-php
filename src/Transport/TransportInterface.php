<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Transport;

use Psr\Http\Message\ResponseInterface;

interface TransportInterface
{
    public const GET = 'GET';
    public const POST = 'POST';

    /**
     * Send an HTTP request.
     *
     * @param string                  $method the HTTP method (GET, POST)
     * @param string                  $path   the path for the request
     * @param array                   $params the GET parameters for the request
     * @param array<string, resource> $files  the files to be sent with the request
     *
     * @return ResponseInterface the response from the server
     */
    public function send(string $method, string $path, array $params = [], array $files = []): ResponseInterface;
}
