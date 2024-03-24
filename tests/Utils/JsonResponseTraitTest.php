<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Tests\Utils;

use CharlaAI\Charla\Utils\JsonResponseTrait;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class JsonResponseTraitTest extends TestCase
{
    use JsonResponseTrait;

    public function testResponseIsConvertedToArray(): void
    {
        $response = new Response(200, [], json_encode(['key' => 'value']));
        $array = $this->toArray($response);
        $this->assertSame(['key' => 'value'], $array);
    }

    public function testEmptyArrayIsReturnedForEmptyResponse(): void
    {
        $response = new Response(200, [], '');
        $array = $this->toArray($response);
        $this->assertSame([], $array);
    }

    public function testEmptyArrayIsReturnedForNonJsonResponse(): void
    {
        $response = new Response(200, [], 'not json');
        $array = $this->toArray($response);
        $this->assertSame([], $array);
    }
}
