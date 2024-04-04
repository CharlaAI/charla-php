<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Tests\Transport;

use CharlaAI\Charla\Options;
use CharlaAI\Charla\Tests\_helpers\PropertyHelper;
use CharlaAI\Charla\Transport\DefaultTransport;
use CharlaAI\Charla\Transport\HttpTransportFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Log\LoggerInterface;
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

    public function testFactoryUsesProvidedClient(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $factory = new HttpTransportFactory(
            $client,
            Psr17FactoryDiscovery::findUriFactory(),
            Psr17FactoryDiscovery::findRequestFactory(),
            new NullLogger()
        );

        $factory->setClient($client);

        $this->assertSame($client, PropertyHelper::getPrivateValue($factory, 'client'));
    }

    public function testFactoryUsesProvidedRequestFactory(): void
    {
        $requestFactory = $this->createMock(RequestFactoryInterface::class);
        $factory = new HttpTransportFactory(
            Psr18ClientDiscovery::find(),
            Psr17FactoryDiscovery::findUriFactory(),
            $requestFactory,
            new NullLogger()
        );

        $factory->setRequestFactory($requestFactory);

        $this->assertSame($requestFactory, PropertyHelper::getPrivateValue($factory, 'requestFactory'));
    }

    public function testFactoryUsesProvidedLogger(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $factory = new HttpTransportFactory(
            Psr18ClientDiscovery::find(),
            Psr17FactoryDiscovery::findUriFactory(),
            Psr17FactoryDiscovery::findRequestFactory(),
            $logger
        );

        $factory->setLogger($logger);

        $this->assertSame($logger, PropertyHelper::getPrivateValue($factory, 'logger'));
    }
}
