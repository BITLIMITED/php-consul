<?php


namespace bitms\Consul\Service;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;

class BuildService
{
    protected Client $client;

    protected LoggerInterface $logger;

    protected string $protocol = 'http';

    protected string $address = '127.0.0.1';

    protected int $port = 8500;

    protected array $headers = [];

    private string $uri;

    public function __construct()
    {
        $this->uri = $this->getAddress();
    }

    public function setBuildAddress(object $data)
    {
        $this->protocol = $data->protocol;
        $this->address = $data->address;
        $this->port = $data->port;
    }

    public function setAddress(string $address):void
    {
        $this->address = $address;
    }

    public function setProtocol(string $protocol):void
    {
        $this->protocol = $protocol;
    }

    public function setPort(int $port):void
    {
        $this->port = $port;
    }

    public function getAddress():string
    {
        return sprintf('%s://%s:%s', $this->protocol, $this->address, $this->port);
    }

    public function setHeader(string $name, string $value):void
    {
        $this->headers[$name] = $value;
    }

    public function setToken(string $token):void
    {
        $this->setHeader('X-Consul-Token', $token);
    }

    protected function get(string $path, array $param = [])
    {
        return $this->request('GET', $path, $param);
    }

    protected function put(string $path, array $param = [])
    {
        return $this->request('PUT', $path, $param);
    }

    protected function delete(string $path, array $param = [])
    {
        return $this->request('DELETE', $path, $param);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $params
     * @param bool $decode
     * @return array|\Psr\Http\Message\StreamInterface
     */
    protected function request(string $method, string $path, array $params = [], bool $decode = true):?array
    {
        $uri = $this->getAddress() . $path;
        $params['headers'] = $this->headers;

        $result = [];

        try {
            $request = $this->client->request($method, $uri, $params);
            $body = $request->getBody();

            $this->logger->debug(sprintf("Response:\n%s", $body));
            if(400 <= $request->getStatusCode()) {
                $message = sprintf('Consul responded with error (%s - %s).',
                    $request->getStatusCode(),
                    $request->getReasonPhrase()
                );
                $this->logger->error($message);
            }

            if($decode === true) {
                $result = json_decode($body, true);
            }
            $result = $body;

        }catch (\Exception | GuzzleException $exception) {
            $message = sprintf('Failed to to perform request to consul (%s).', $exception->getMessage());
            $this->logger->error($message);
        } finally {
            $this->headers = [];
        }

        return $result;
    }
}