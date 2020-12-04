<?php


namespace bitms\Consul;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

class Factory
{
    protected array $services = [

    ];

    protected Client $client;

    protected LoggerInterface $logger;

    protected string $address;

    public function __construct(string $address = '', array $services = [])
    {
        $this->address = $address;
        $this->services = $services;
    }
    public function get(string $service, array $params = []) : BaseService
    {
        if (!array_key_exists($service, $this->services)) {
            throw new \InvalidArgumentException(sprintf('The service "%s" is not available.', $service));
        }
        $class = $this->services[$service];
        $args = [$this->client, $this->logger, $this->consulAddress];
        foreach ($params as $param) {
            $args[] = $param;
        }
        return new $class(...$args);
    }

}