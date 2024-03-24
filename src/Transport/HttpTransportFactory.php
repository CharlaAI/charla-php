<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Transport;

use CharlaAI\Charla\Options;
use Http\Client\Common\HttpMethodsClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Factory class for creating HTTP transport instances.
 */
final class HttpTransportFactory implements TransportFactoryInterface
{
    private ClientInterface $client;
    private UriFactoryInterface $uriFactory;
    private RequestFactoryInterface $requestFactory;
    private LoggerInterface $logger;

    /**
     * Constructor for the HttpTransportFactory class.
     *
     * @param ClientInterface|null         $client         The HTTP client to use. If not provided, a default client will be discovered.
     * @param UriFactoryInterface|null     $uriFactory     The URI factory to use. If not provided, a default factory will be discovered.
     * @param RequestFactoryInterface|null $requestFactory The request factory to use. If not provided, a default factory will be discovered.
     * @param LoggerInterface|null         $logger         The logger to use. If not provided, a NullLogger will be used.
     */
    public function __construct(
        ?ClientInterface $client,
        ?UriFactoryInterface $uriFactory,
        ?RequestFactoryInterface $requestFactory,
        ?LoggerInterface $logger,
    ) {
        $this->client = $client ?? Psr18ClientDiscovery::find();
        $this->uriFactory = $uriFactory ?? Psr17FactoryDiscovery::findUriFactory();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->logger = $logger ?? new NullLogger();
    }

    /**
     * Creates a new instance of the DefaultTransport class.
     *
     * @param Options $options the options to use for the transport
     *
     * @return TransportInterface the created transport
     */
    public function create(Options $options): TransportInterface
    {
        return new DefaultTransport(
            options: $options,
            baseUri: $this->uriFactory->createUri($options->getEndpoint()),
            httpClient: new HttpMethodsClient($this->client, $this->requestFactory),
            logger: $this->logger
        );
    }

    /**
     * Sets the HTTP client to use.
     *
     * @param ClientInterface $client the client to use
     *
     * @return self the factory instance
     */
    public function setClient(ClientInterface $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Sets the request factory to use.
     *
     * @param RequestFactoryInterface $requestFactory the request factory to use
     *
     * @return self the factory instance
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory): self
    {
        $this->requestFactory = $requestFactory;

        return $this;
    }

    /**
     * Sets the logger to use.
     *
     * @param LoggerInterface $logger the logger to use
     *
     * @return self the factory instance
     */
    public function setLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;

        return $this;
    }
}
