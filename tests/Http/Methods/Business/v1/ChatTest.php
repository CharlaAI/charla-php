<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Tests\Http\Methods\Business\v1;

use CharlaAI\Charla\Http\Methods\Business\v1\Chat;
use CharlaAI\Charla\Response\Response;
use CharlaAI\Charla\Transport\TransportInterface;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use PHPUnit\Framework\TestCase;

class ChatTest extends TestCase
{
    public function testChatListReturnsResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->method('send')->willReturn(new GuzzleResponse());

        $chat = new Chat($transport);
        $response = $chat->list();

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testChatGetReturnsResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->method('send')->willReturn(new GuzzleResponse());

        $chat = new Chat($transport);
        $response = $chat->get(1);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testChatTranscribeReturnsResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->method('send')->willReturn(new GuzzleResponse());

        $chat = new Chat($transport);
        $response = $chat->transcribe(fopen('php://temp', 'r'));

        $this->assertInstanceOf(Response::class, $response);
    }
}
