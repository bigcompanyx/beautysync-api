<?php

namespace App\Tests;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\PropertyAccess\PropertyAccess;
use function Symfony\Component\String\u;

class ImprovedApiTestCase extends ApiTestCase
{
    private $propertyAccessor;

    public function __construct()
    {
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();

        parent::__construct();
    }

    public function getRequestBody(array $requestParams, object $DTO): array
    {

        if (($key = array_search('id', $requestParams)) !== false) {
            unset($requestParams[$key]);
        }

        $requestBody = [];
        array_walk($requestParams, function($param) use(&$requestBody, $DTO){
            $propertyName = u($param)->snake();
            $value = $this->propertyAccessor->getValue($DTO, $propertyName);
            if($value instanceof \DateTimeInterface){
                $value = $value->format('Y-m-d H:i:s');
            }
            $requestBody[$param] = $value;
        });

        return $requestBody;

    }
}