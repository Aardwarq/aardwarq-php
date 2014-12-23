<?php

namespace Aardwarq\Api;

class Client
{
    static protected $baseUrl = 'http://aardwarq.com.dev/api/v{version}/';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzleClient;

    /**
     * @var string
     */
    public $accessToken;

    public function __construct($accessToken)
    {
        $this->guzzleClient = new \GuzzleHttp\Client([
            'base_url' => [ static::$baseUrl, ['version' => 1] ],
            'defaults' => [
                'headers' => [
                    'content-type'  => 'application/json',
                    'Authorization' => 'Bearer '. $accessToken
                ],
            ]
        ]);
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getGuzzleClient()
    {
        return $this->guzzleClient;
    }

    /**
     * @param \GuzzleHttp\Client $guzzleClient
     *
     * @return Client
     */
    public function setGuzzleClient(\GuzzleHttp\Client $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;

        return $this;
    }

    /**
     * @param \JsonSerializable $event
     *
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function send(\JsonSerializable $event)
    {
        $request = $this->getGuzzleClient()->post('events', [
            'body' => json_encode($event, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_BIGINT_AS_STRING)
        ]);

        return $request;
    }

}
