<?php

namespace AkuratecoTest\Interfaces;

interface ResponseInterface
{
    public function getStatusCode();
    public function getBody();
}
