<?php


namespace bitms\Consul\Service;


use bitms\Consul\Model\Service;

class Registry extends BuildService
{
    private string $registerUri = '/v1/agent/service/register';

    private string $unregisterUri = '/v1/agent/service/deregister/%s';

    public function install(Service $service)
    {
        $params['body'] = [
            'Id' => $service->getId(),
            'Name' => $service->getName(),
            'Tag' => $service->getTag(),
            'Address' => $service->getAddress(),
            'Port' => $service->getPort(),
            'Check' => [
                'Name' => 'ping check',
                'DeregisterCriticalServiceAfter' => '10m',
                'Args' => ['ping', '-c1', 'learn.hashicorp.com'],
                'Interval' => '10s',
                'Timeout' => '5s',
                'Status' => 'passing'
            ]
        ];

        return $this->put($this->registerUri, $params);
    }

    public function uninstall(Service $service)
    {
        $uri = sprintf($this->unregisterUri, $service->getId());

        return $this->delete($uri);
    }


}