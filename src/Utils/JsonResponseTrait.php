<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Utils;

use Psr\Http\Message\ResponseInterface;

/**
 * Trait JsonResponseTrait
 *
 * This trait provides a method to convert a PSR-7 ResponseInterface object into an array.
 */
trait JsonResponseTrait
{
    /**
     * Convert a PSR-7 ResponseInterface object into an array.
     *
     * @param ResponseInterface $response the PSR-7 ResponseInterface object to convert
     *
     * @return array the converted array
     */
    protected function toArray(ResponseInterface $response): array
    {
        return (array) json_decode($response->getBody()->getContents(), true);
    }
}
