<?php


namespace bitms\Consul\DependencyInjection;

use Symfony\Bridge\Doctrine\DependencyInjection\AbstractDoctrineExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Configuration;

class ConsulExtension extends AbstractDoctrineExtension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = [
            'consul' => [
                "serviceName",
                "hostName",
                "port",
                "ttl"
            ]
        ];

        $config = $this->processConfiguration($configuration, $configs);

        // you now have these 2 config keys
        // $config['twitter']['client_id'] and $config['twitter']['client_secret']
    }
}