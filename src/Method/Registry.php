<?php


namespace bitms\Consul\Method;


class Registry
{
    /**
     * @var string
     */
    private string $storageKey;

    /**
     * Registry constructor.
     * @param string $hostname
     * @param string $keyword
     * @param string $filename
     */
    public function __construct(string $hostname = '', string $keyword = '', string $filename = '')
    {
        $this->setStorageKey($hostname, $keyword, $filename);
    }

    /**
     * @param string $hostname
     * @param string $keyword
     * @param string $filename
     *
     * @return void
     */
    public function setStorageKey(string $hostname, string $keyword, string $filename):void
    {
        $this->storageKey = sprintf('%s/%s/%s', $hostname, $keyword, $filename);
    }

    public function addRegistry()
    {
        if (apcu_exists($this->storageKey)) {
            $storageValue = apcu_fetch($this->storageKey, $success);

            if(empty($success))
                throw new \RuntimeException('Failed to get APCU cache value');

        } else {
            /**
             * Register the service and save the configuration
             */

        }

    }
}