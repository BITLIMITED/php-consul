<?php


namespace bitms\Consul;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class InstallerPlugin implements PluginInterface
{
    private string $controller;

    public function __construct()
    {
        $this->controller = dirname(__FILE__,5) . '/src/Controller/ConsulController.php';
    }

    /**
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $controller = dirname(__FILE__) . '/Controller/ConsulController.txt';

        $content = "<?php
        namespace App\Controller;
        
        ";
        $content .= file_get_contents($controller);

        file_put_contents($this->controller, $content);
    }

    /**
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function deactivate(Composer $composer, IOInterface $io)
    {
        // TODO: Implement deactivate() method.
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
        @unlink($this->controller);
    }
}