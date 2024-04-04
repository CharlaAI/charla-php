<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Transport;

use CharlaAI\Charla\Options;

interface TransportFactoryInterface
{
    public function create(Options $options): TransportInterface;
}
