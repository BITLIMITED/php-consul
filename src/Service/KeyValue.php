<?php


namespace bitms\Consul\Service;

use bitms\Consul\Model\KeyValue as Model;

class KeyValue extends BuildService
{
    /**
     * @param string $storageKey
     * @return Model|null
     */
    public function getKayValue(string $storageKey)
    {
        $response = $this->request('GET', '/v1/kv/' . $storageKey,[],false);

        $body = $response->getContents();

        if (empty($body))
            return null;

        $data = json_decode($body, true);
        $keyValue = new Model();
        $keyValue->setKey($data[0]['Key']);
        $keyValue->setValue(base64_decode($data[0]['Value']));

        return $keyValue;
    }
}