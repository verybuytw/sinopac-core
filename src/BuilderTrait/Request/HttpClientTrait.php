<?php

namespace VeryBuy\Payment\SinoPac\BuilderTrait\Request;

use GuzzleHttp\Client;

trait HttpClientTrait
{
    /**
     * @var Client|null
     */
    protected $client;

    /**
     * @param  array        $options
     * @param  Closure|null $callback
     * @return Client
     */
    protected function getClient(array $options = []): Client
    {
        return $this->client ?? $this->client = $this->genClient($options);
    }

    /**
     * @param  array  $options
     * @return Client
     */
    protected function genClient(array $options = []): Client
    {
        /* 永豐 API 請求不接受預設的 Guzzle User Agent */
        $options['headers']['User-Agent'] = 'Verybuy';
        return (new Client($options));
    }
}
