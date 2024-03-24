<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Tests\Http;

use CharlaAI\Charla\Http\Client;
use CharlaAI\Charla\Transport\TransportInterface;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class ClientTest extends TestCase
{
    public function testClientCallsMethodSuccessfully(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $client = new Client($transport);
        $method = $client->call(TestMethod::class);
        $this->assertInstanceOf(TestMethod::class, $method);
    }

    public function testClientThrowsExceptionForNonexistentClass(): void
    {
        $this->expectException(RuntimeException::class);
        $transport = $this->createMock(TransportInterface::class);
        $client = new Client($transport);
        $client->call('NonexistentClass');
    }
}
