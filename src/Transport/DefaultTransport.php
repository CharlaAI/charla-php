<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Transport;

use CharlaAI\Charla\Exception\InvalidHttpMethodException;
use CharlaAI\Charla\Options;
use CharlaAI\Charla\Utils\FileUtils;
use Http\Client\Common\HttpMethodsClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Psr\Log\LoggerInterface;

/**
 * Class DefaultTransport
 *
 * This class implements the TransportInterface and provides methods to send HTTP requests.
 */
class DefaultTransport implements TransportInterface
{
    private array $headers = [];

    /**
     * DefaultTransport constructor.
     *
     * @param Options                    $options    the options object containing the configuration for the transport
     * @param UriInterface               $baseUri    the base URI for the HTTP requests
     * @param HttpMethodsClientInterface $httpClient the HTTP client used to send requests
     * @param LoggerInterface            $logger     the logger used to log information about the requests
     */
    public function __construct(
        private Options $options,
        private UriInterface $baseUri,
        private HttpMethodsClientInterface $httpClient,
        private LoggerInterface $logger,
    ) {
        $this->headers = static::generateHeaders($this->options);
    }

    /**
     * Send an HTTP request.
     *
     * @param string                  $method the HTTP method (GET, POST)
     * @param string                  $path   the path for the request
     * @param array                   $params the GET parameters for the request
     * @param array<string, resource> $files  the files to be sent with the request
     *
     * @return ResponseInterface the response from the server
     *
     * @throws \Http\Client\Exception if there is an error with the request
     */
    public function send(string $method, string $path, array $params = [], array $files = []): ResponseInterface
    {
        self::validateMethod($method);

        $this->logger->info('Preparing to send request', [
            'method' => $method,
            'path' => $path,
            'headers' => $this->headers,
            'params' => $params,
        ]);

        $uri = $this->baseUri->withPath($path)->withQuery(http_build_query($params));

        $body = !empty($files) ? FileUtils::toMultipartStream($files) : null;

        return $this->httpClient->send($method, $uri, headers: $this->headers, body: $body);
    }

    /**
     * Validate the HTTP method.
     *
     * @param string $method the HTTP method to validate
     *
     * @throws InvalidHttpMethodException if the method is not GET or POST
     */
    private static function validateMethod(string $method): void
    {
        if (!in_array($method, [self::GET, self::POST], true)) {
            throw new InvalidHttpMethodException($method);
        }
    }

    /**
     * Generate the headers for the HTTP request.
     *
     * @param Options $options the options object containing the configuration for the headers
     *
     * @return array the headers for the HTTP request
     */
    private static function generateHeaders(Options $options): array
    {
        return array_filter([
            'User-Agent' => $options->getUserAgent(),
            'Authorization' => "Bearer {$options->getToken()}",
        ]);
    }
}
