<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Tests\Http;

use CharlaAI\Charla\Http\Methods\MethodInterface;
use CharlaAI\Charla\Transport\TransportInterface;

class TestMethod implements MethodInterface
{
    public function __construct(TransportInterface $transport)
    {
    }
}
