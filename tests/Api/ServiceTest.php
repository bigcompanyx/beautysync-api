<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\ServiceFactory;
use App\Tests\ImprovedApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class ServiceTest extends ImprovedApiTestCase
{
    use ResetDatabase, Factories;

    const SERVICE_DATA = [
        'id',
        'name',
        'price',
        'description',
        'duration'
    ];
    
    const API_ENDPOINT = '/api/services';

    public function testServiceGetCollection() {

        ServiceFactory::createMany(10);

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testServiceGet() {
        $service = ServiceFactory::createOne();

        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/'.$service->getId(),[
            'headers' => [
                'accept' => 'application/json'
            ]
        ])->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::SERVICE_DATA, array_keys($response));

    }
    
    public function testServiceDelete() {
        $service = ServiceFactory::createOne();

        static::createClient()->request('DELETE', self::API_ENDPOINT.'/'.$service->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testServiceUpdate() {
        $service = ServiceFactory::createOne();
        $service2 = ServiceFactory::new()->withoutPersisting()->createOne()->object();

        static::createClient()->request('PATCH', self::API_ENDPOINT.'/'.$service->getId(), [
            'headers' =>[
                'Content-Type' => 'application/merge-patch+json'
            ],
            'body' => json_encode($this->getRequestBody(self::SERVICE_DATA, $service2))
        ]);

        $this->assertResponseIsSuccessful();
    }

    public function testServiceCreate() {
        $service = ServiceFactory::new()->withoutPersisting()->createOne()->object();

        static::createClient()->request('POST', self::API_ENDPOINT, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body'  => json_encode($this->getRequestBody(self::SERVICE_DATA, $service))
        ]);

        $this->assertResponseIsSuccessful();
    }

}