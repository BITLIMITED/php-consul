<?php


namespace bitms\Consul\Model\Service;


class AgentCheck
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $deregister;

    /**
     * @var string
     */
    private string $http;

    /**
     * @var bool
     */
    private bool $tls = false;

    /**
     * @var string
     * @enum: POST, GET, PUT
     */
    private string $method = 'POST';

    /**
     * @var array
     */
    private array $header = [];

    /**
     * @var array
     */
    private array $body = [];

    /**
     * @var string
     */
    private string $interval;

    /**
     * @var string
     */
    private string $timeout;

    /**
     * AgentCheck constructor.
     * Set the value of required parameters by default
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDeregister(): string
    {
        return $this->deregister;
    }

    /**
     * @param string $deregister
     */
    public function setDeregister(string $deregister): void
    {
        $this->deregister = $deregister;
    }

    /**
     * @return string
     */
    public function getHttp(): string
    {
        return $this->http;
    }

    /**
     * @param string $http
     */
    public function setHttp(string $http): void
    {
        $this->http = $http;
    }

    /**
     * @return bool
     */
    public function isTls(): bool
    {
        return $this->tls;
    }

    /**
     * @param bool $tls
     */
    public function setTls(bool $tls): void
    {
        $this->tls = $tls;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @param array $header
     */
    public function setHeader(array $header): void
    {
        $this->header = $header;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @param array $body
     */
    public function setBody(array $body): void
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getInterval(): string
    {
        return $this->interval;
    }

    /**
     * @param string $interval
     */
    public function setInterval(string $interval): void
    {
        $this->interval = $interval;
    }

    /**
     * @return string
     */
    public function getTimeout(): string
    {
        return $this->timeout;
    }

    /**
     * @param string $timeout
     */
    public function setTimeout(string $timeout): void
    {
        $this->timeout = $timeout;
    }
}