<?php

namespace AkuratecoTest\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use AkuratecoTest\Interfaces\RequestInterface;
use Exception;

class GuzzleRequest implements RequestInterface
{
    private $client;
    private $url;
    private $postData;

    public function __construct($url, $postData)
    {
        $this->client = new Client();
        $this->url = $url;
        $this->postData = $postData;
    }

    public function send()
    {
        try {
            $response = $this->client->request('POST', $this->url, [
                'form_params' => $this->postData
            ]);
            return new GuzzleResponse($response);
        } catch (GuzzleException $e) {
            throw new Exception("Error: " . $e->getResponse()->getBody()->getContents());
        }
    }
}
