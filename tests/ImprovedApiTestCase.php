<?php

namespace App\Tests;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\PropertyAccess\PropertyAccess;
use function Symfony\Component\String\u;

class ImprovedApiTestCase extends ApiTestCase
{
    private $propertyAccessor;
    private $entityManager;

    public function __construct(

    )
    {
        $this->entityManager = static::getContainer()->get(EntityManagerInterface::class);

        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();

        parent::__construct();
    }

    protected function getRequestBody(array $requestParams, object $DTO): array
    {
        $entitiesClassNames = $this->entityManager->getConfiguration()->getMetadataDriverImpl()->getAllClassNames();

        if (($key = array_search('id', $requestParams)) !== false) {
            unset($requestParams[$key]);
        }

        $requestBody = [];
        array_walk($requestParams, function($propertyName) use(&$requestBody, $DTO, $entitiesClassNames){
            $propertyName = u($propertyName)->camel()->toString();
            $value = $this->propertyAccessor->getValue($DTO, $propertyName);

            if($value instanceof \DateTimeInterface){
                $value = $value->format('Y-m-d H:i:s');
            }
          
            array_walk($entitiesClassNames, function($entityName) use(&$value, $propertyName, &$requestBody){

                if($value instanceof $entityName){
                    $value = $this->getIriFromResource($value);
                }

                if($value instanceof PersistentCollection){
                    $valueArray = $value->toArray();
                    $singleValue = $valueArray[array_key_first($valueArray)];
                
                    if($singleValue instanceof $entityName){
               
                        $value = array_map(function($item){
                            return $this->getIriFromResource($item);
                        }, $valueArray);
                      
                    }
                }


            });
            $requestBody[$propertyName] = $value;
        });

        return $requestBody;

    }

    protected function assertArrayHasKeys(callable|array $expectedData, array $actualData)
    {
        if(is_callable($expectedData)){
            $expectedData = call_user_func($expectedData);
        }

        array_walk($expectedData, function($key) use($actualData){
            $this->assertArrayHasKey($key, $actualData);
        });
    }
}