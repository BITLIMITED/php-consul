<?php


namespace bitms\Consul\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder() : TreeBuilder
    {
        $treeBuilder = new TreeBuilder('consul');

        $treeBuilder->getRootNode()
            ->children()
                        ->scalarNode('serverName')->end()
                        ->scalarNode('hostName')->end()
                        ->scalarNode('port')->end()
                        ->scalarNode('ttl')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}