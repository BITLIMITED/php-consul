<?php


namespace bitms\Consul\Model;


class Service
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $id;

    /**
     * @var string
     */
    protected string $address;

    /**
     * @var int
     */
    protected int $port;

    /**
     * @var array
     */
    protected array $tag;

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