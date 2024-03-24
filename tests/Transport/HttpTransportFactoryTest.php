<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Tests\Transport;

use CharlaAI\Charla\Options;
use CharlaAI\Charla\Transport\DefaultTransport;
use CharlaAI\Charla\Transport\HttpTransportFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class HttpTransportFactoryTest extends TestCase
{
    public function testTransportIsCreatedSuccessfully(): void
    {
        $factory = new HttpTransportFactory(
            Psr18ClientDiscovery::find(),
            Psr17FactoryDiscovery::findUriFactory(),
            Psr17FactoryDiscovery::findRequestFactory(),
            new NullLogger()
        );

        $transport = $factory->create(new Options('token', 'endpoint'));

        $this->assertInstanceOf(DefaultTransport::class, $transport);
    }
}
