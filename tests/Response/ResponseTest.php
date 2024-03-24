<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Tests\Response;

use CharlaAI\Charla\Response\Response;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testResponseIsConvertedToJson(): void
    {
        $response = new GuzzleResponse(200, [], json_encode(['key' => 'value']));
        $charlaResponse = new Response($response);
        $json = $charlaResponse->toJson();
        $this->assertSame(['key' => 'value'], $json);
    }

    public function testEmptyArrayIsReturnedForEmptyResponse(): void
    {
        $response = new GuzzleResponse(200, [], '');
        $charlaResponse = new Response($response);
        $json = $charlaResponse->toJson();
        $this->assertSame([], $json);
    }

    public function testEmptyArrayIsReturnedForNonJsonResponse(): void
    {
        $response = new GuzzleResponse(200, [], 'not json');
        $charlaResponse = new Response($response);
        $json = $charlaResponse->toJson();
        $this->assertSame([], $json);
    }

    public function testOriginalResponseIsReturned(): void
    {
        $response = new GuzzleResponse(200, [], json_encode(['key' => 'value']));
        $charlaResponse = new Response($response);
        $this->assertSame($response, $charlaResponse->getResponse());
    }
}
