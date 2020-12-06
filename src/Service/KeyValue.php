<?php


namespace bitms\Consul\Service;


class KeyValue extends BuildService
{
    /**
     * @param string $storageKey
     * @return array|null
     */
    public function getKayValue(string $storageKey)
    {
        $response = $this->request('GET', '/v1/kv/' . $storageKey,[],false);

        $body = $response->getContents();

        if (empty($body))
            return null;

        $data = json_decode($body, true);

        return [
            'key' => $data[0]['Key'],
            'value' => base64_decode($data[0]['Value'])
        ];
    }
}