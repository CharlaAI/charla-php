<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Tests;

use CharlaAI\Charla\Options;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class OptionsTest extends TestCase
{
    private \Faker\Generator $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testGetTokenReturnsCorrectToken(): void
    {
        $token = $this->faker->uuid;
        $options = new Options($token, 'endpoint');
        $this->assertSame($token, $options->getToken());
    }

    public function testGetEndpointReturnsCorrectEndpoint(): void
    {
        $endpoint = $this->faker->url;
        $options = new Options('token', $endpoint);
        $this->assertSame($endpoint, $options->getEndpoint());
    }

    public function testGetUserAgentReturnsCorrectUserAgentWhenProvided(): void
    {
        $userAgent = $this->faker->userAgent;
        $options = new Options('token', 'endpoint', $userAgent);
        $this->assertSame($userAgent, $options->getUserAgent());
    }

    public function testGetUserAgentReturnsDefaultUserAgentWhenNotProvided(): void
    {
        $options = new Options('token', 'endpoint');
        $this->assertSame('php/charla-sdk-client', $options->getUserAgent());
    }
}
