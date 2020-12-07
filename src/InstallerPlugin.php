<?php

namespace bitms\Consul;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Symfony\Component\Yaml\Yaml;

class InstallerPlugin implements PluginInterface
{
    /**
     * @var string
     */
    private string $controller;

    /**
     * InstallerPlugin constructor.
     */
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
        /**
         * Create config file for ACPU
         */
        $this::createConfig();

        /**
         * Create index
         */
        $this::createIndex();

        /**
         * Create Consul Controller
         */
        $this::createController();
    }

    /**
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function deactivate(Composer $composer, IOInterface $io)
    {
        // TODO: Implement deactivate() method.
    }

    /**
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function uninstall(Composer $composer, IOInterface $io)
    {
        @unlink($this->controller);
    }

    /**
     *
     */
    private function createController()
    {
        $controller = dirname(__FILE__) . '/Controller/ConsulController.txt';

        $content = "<?php
        namespace App\Controller;
        
        ";
        $content .= file_get_contents($controller);

        file_put_contents($this->controller, $content);
    }

    /**
     *
     */
    private function createConfig()
    {
        $config = dirname(__FILE__,5) . '/config/packages/consul.yaml';

        $data = [
            'serviceName' => '%serviceName%',
            'hostName'    => '%hostName%',
            'port'        => '%portNumber%',
            'ttl'         => '%ttl%'
        ];

        $yaml = Yaml::dump($data);

        file_put_contents($config, $yaml);
    }

    private function createIndex()
    {
        $content = "<?php";
        $content.= "use App\Kernel;";
        $content.= "use Symfony\Component\ErrorHandler\Debug;";
        $content.= "use Symfony\Component\HttpFoundation\Request;";
        $content.= "use Symfony\Component\Yaml\Yaml;";
        $content.= "";
        $content.= 'require dirname(__DIR__)."/vendor/autoload.php";';
        $content.= "";
        $content.= '$yaml = Yaml::parseFile("../config/packages/consul.yaml")';
        $content.= '$storageKey = gethostname() ."/". $yaml["serviceName"] . "/" .$yaml["hostName"] ."_". $yaml["port"] . ".json"';
        $content.= 'if (apcu_exists($storageKey)) {';
        $content.= '} else {';
        $content.= '    $storageValue = json_decode($storage->getKeyValue($storageKey)->getValue());';
        $content.= '    apcu_add($storageKey, $storageValue, $yaml["ttl"]);';
        $content.= '}';
        $content.= 'if ($storageValue->env->APP_DEBUG) {';
        $content.= '    umask(0000);';
        $content.= '    Debug::enable();';
        $content.= '}';
        $content.= '$kernel = new Kernel($storageValue->env->APP_ENV, (bool) $storageValue->env->APP_DEBUG);';
        $content.= '$request = Request::createFromGlobals();';
        $content.= '$response = $kernel->handle($request);';
        $content.= '$response->send();';
        $content.= '$kernel->terminate($request, $response);';

        $index = dirname(__FILE__,5). '/public/index.php';
        file_put_contents($index, $content,LOCK_EX);
    }

}