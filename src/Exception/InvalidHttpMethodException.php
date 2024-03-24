<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Exception;

use RuntimeException;
use Throwable;

final class InvalidHttpMethodException extends RuntimeException
{
    public function __construct(
        string $receivedValue,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            message: sprintf('Invalid http method. Expected: GET, POST. Received: %s', $receivedValue),
            code: $code,
            previous: $previous,
        );
    }
}
