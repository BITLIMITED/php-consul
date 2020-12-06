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
            'Tags' => $service->getTag(),
            'Address' => $service->getAddress(),
            'Port' => $service->getPort(),
            'Checks' => $service->getChecks()
        ];

        return $this->put($this->registerUri, $params);
    }

    public function uninstall(string $serviceId)
    {
        $uri = sprintf($this->unregisterUri, $serviceId);

        return $this->delete($uri);
    }


}