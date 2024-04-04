<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Tests\Transport;

use CharlaAI\Charla\Exception\InvalidHttpMethodException;
use CharlaAI\Charla\Options;
use CharlaAI\Charla\Transport\DefaultTransport;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Uri;
use Http\Client\Common\HttpMethodsClientInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class DefaultTransportTest extends TestCase
{
    private HttpMethodsClientInterface $httpClient;
    private Options $options;
    private Uri $baseUri;
    private NullLogger $logger;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(HttpMethodsClientInterface::class);
        $this->options = new Options('token', 'endpoint');
        $this->baseUri = new Uri('https://api.example.com');
        $this->logger = new NullLogger();
    }

    public function testRequestIsSentSuccessfully(): void
    {
        $this->httpClient
            ->expects($this->once())
            ->method('send')
            ->willReturn(new Response());

        $transport = new DefaultTransport($this->options, $this->baseUri, $this->httpClient, $this->logger);
        $response = $transport->send('GET', '/path');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testInvalidHttpMethodThrowsException(): void
    {
        $this->expectException(InvalidHttpMethodException::class);

        $transport = new DefaultTransport($this->options, $this->baseUri, $this->httpClient, $this->logger);
        $transport->send('INVALID', '/path');
    }
}
