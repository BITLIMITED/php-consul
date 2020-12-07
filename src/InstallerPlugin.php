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
            'consul' => [
                'serviceName' => '#serviceName#',
                'hostName'    => '#hostName#',
                'port'        => '#portNumber#',
                'ttl'         => '#ttl#'
            ]
        ];

        $yaml = Yaml::dump($data);

        file_put_contents($config, $yaml);
    }

    private function createIndex()
    {
        $content = '<?php
use App\Kernel;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;
use bitms\Consul\Service\KeyValue;
        
require dirname(__DIR__)."/vendor/autoload.php";
               
$yaml = Yaml::parseFile("../config/packages/consul.yaml");
$consulConfig = $yaml["consul"];

$storage = new KeyValue;
$storageKey = gethostname() ."/". $consulConfig["serviceName"] . "/" .$consulConfig["hostName"] ."_". $consulConfig["port"] . ".json";
if (apcu_exists($storageKey)) {
    $storageValue = apcu_fetch($storageKey, $success);
    if (!$success)
        throw new \RuntimeException("Failed to get APCU cache value");
    
}else{
    $storageValue = json_decode($storage->getKeyValue($storageKey)->getValue());
    apcu_add($storageKey, $storageValue, $yaml["ttl"]);
}

if ($storageValue->env->APP_DEBUG) {
    umask(0000);
    Debug::enable();
}

$kernel = new Kernel($storageValue->env->APP_ENV, (bool) $storageValue->env->APP_DEBUG);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
';

        $index = dirname(__FILE__,5). '/public/index.php';
        file_put_contents($index, $content,LOCK_EX);
    }

}