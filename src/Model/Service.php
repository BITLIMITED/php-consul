<?php


namespace bitms\Consul\Model;


use bitms\Consul\Model\Service\AgentCheck;

class Service
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $address = '127.0.0.1';

    /**
     * @var int
     */
    private int $port;

    /**
     * @var array
     */
    private array $tag;

    /**
     * @var array
     */
    private array $checks;

    /**
     * @var AgentCheck
     */
    public AgentCheck $check;

    /**
     * Service constructor.
     */
    public function __construct()
    {
        $this->check = new AgentCheck;
    }

    /**
     * @param AgentCheck $check
     */
    public function setChecks(AgentCheck $check):void
    {
        $this->checks[] = [
            'Name' => $check->getName(),
            'Http' => $check->getHttp(),
            'Method' => $check->getMethod(),
            'TlsSkipVerify' => $check->isTls(),
            'Header' => $check->getHeader(),
            'Body' => $check->getBody(),
            'DeregisterCriticalServiceAfter' => $check->getDeregister(),
            'Interval' => $check->getInterval(),
            'Timeout' => $check->getTimeout()
        ];
    }

    /**
     * @return array
     */
    public function getChecks():array
    {
        return $this->checks;
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
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * @return array
     */
    public function getTag(): array
    {
        return $this->tag;
    }

    /**
     * @param array $tag
     */
    public function setTag(array $tag): void
    {
        $this->tag = $tag;
    }

    /**
     * @param string $tag
     */
    public function addTag(string $tag):void
    {
        $this->tag[] = $tag;
    }
}