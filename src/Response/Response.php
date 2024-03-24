<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Response;

use CharlaAI\Charla\Utils\JsonResponseTrait;
use Psr\Http\Message\ResponseInterface;

class Response
{
    use JsonResponseTrait;

    public function __construct(private ResponseInterface $response)
    {
    }

    public function toJson(): array
    {
        return $this->toArray($this->response);
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
