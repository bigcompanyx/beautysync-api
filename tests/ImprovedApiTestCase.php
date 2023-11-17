<?php

namespace App\Tests;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class ImprovedApiTestCase extends ApiTestCase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRequestBody(array $requestParams, object $DTO): array
    {
        if (($key = array_search('id', $requestParams)) !== false) {
            unset($requestParams[$key]);
        }

        $requestBody = [];
        array_walk($requestParams, function($param) use(&$requestBody, $DTO){
            $requestBody[$param] = $DTO->{'get'.ucfirst($param)}();
        });

        return $requestBody;

    }
}