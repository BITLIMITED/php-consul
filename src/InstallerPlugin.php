<?php


namespace bitms\Consul;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class InstallerPlugin implements PluginInterface
{
    /**
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $dir = dirname(__FILE__,5);

        $file = $dir . '/src/Controller/IndexMyController.php';

        file_put_contents($file, json_encode([]));
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
        // TODO: Implement uninstall() method.
    }
}