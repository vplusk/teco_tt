<?php

namespace AkuratecoTest\Requests;

use GuzzleHttp\Psr7\Response;
use AkuratecoTest\Interfaces\ResponseInterface;

class GuzzleResponse implements ResponseInterface
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }

    public function getBody()
    {
        return $this->response->getBody()->getContents();
    }
}
