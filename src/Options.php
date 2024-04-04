<?php

declare(strict_types=1);

namespace CharlaAI\Charla;

/**
 * Class Options
 *
 * This class provides methods to get the token, endpoint, and user agent for the HTTP requests.
 */
final class Options
{
    private const DEFAULT_USER_AGENT = 'php/charla-sdk-client';

    /**
     * Options constructor.
     *
     * @param string      $token     the token for the HTTP requests
     * @param string      $endpoint  the endpoint for the HTTP requests
     * @param string|null $userAgent The user agent for the HTTP requests. If not provided, a default user agent is used.
     */
    public function __construct(
        private string $token,
        private string $endpoint,
        private ?string $userAgent = self::DEFAULT_USER_AGENT,
    ) {
    }

    /**
     * Get the token for the HTTP requests.
     *
     * @return string the token for the HTTP requests
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get the endpoint for the HTTP requests.
     *
     * @return string the endpoint for the HTTP requests
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Get the user agent for the HTTP requests.
     *
     * @return string|null The user agent for the HTTP requests. If not provided, a default user agent is used.
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }
}
